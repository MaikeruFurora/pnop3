<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use App\Helpers\Helper;
use App\Models\BackSubject;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherSHSController extends Controller
{
    use Traits\StudentStatus;
    public function assign()
    {
        // return Auth::user()->section->strand_id;

        $subjects = Subject::whereNull('subject_for')
            ->orWhere('strand_id', Auth::user()->section->strand_id)
            ->orWhere('grade_level', Auth::user()->section->grade_level)
            ->get();
        $teachers = Teacher::select('id', DB::raw("CONCAT(teachers.teacher_lastname,', ',teachers.teacher_firstname,' ',teachers.teacher_middlename) as teacher_name"))->get();
        return view('teacher/assign-shs', compact('subjects', 'teachers'));
    }

    public function classMonitor()
    {
        return view('teacher/classMonitor-shs');
    }

    public function myClass($term)
    {
        return response()->json([
            'data' => Enrollment::select(
                "enrollments.id",
                "enrollments.enroll_status",
                "students.roll_no",
                "students.student_contact",
                "students.gender",
                "sections.section_name",
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->join('students', 'enrollments.student_id', 'students.id')
                ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
                ->where('sections.teacher_id', Auth::user()->id)
                ->where('school_years.status', 1)
                ->where('enrollments.grade_level', Auth::user()->section->grade_level)
                ->where('enrollments.term', $term)
                ->whereIn('enrollments.enroll_status', ['Enrolled', 'Dropped'])
                ->orderBy('students.student_lastname')
                ->get()
        ]);
    }

    public function assignListStudent($term)
    {
        return response()->json([
            'data' => Enrollment::select(
                "students.id as stud_id",
                "enrollments.id",
                "enrollments.enroll_status",
                "students.roll_no",
                "students.student_contact",
                "students.gender",
                "sections.section_name",
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->join('students', 'enrollments.student_id', 'students.id')
                ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
                ->where('sections.teacher_id', Auth::user()->id)
                ->where('school_years.status', 1)
                ->where('enrollments.grade_level', Auth::user()->section->grade_level)
                ->where('enrollments.term', $term)
                ->whereIn('enrollments.enroll_status', ['Enrolled', 'Dropped'])
                ->orderBy('students.student_lastname')
                ->get()
        ]);
    }

    public function showSubjectList($term, $enrollment)
    {
        return response()->json([]);
    }

    public function listAssignSubject($term)
    {
        return response()->json(
            Assign::select('assigns.id', 'subjects.id as subj_id', 'subjects.descriptive_title', DB::raw("CONCAT(teachers.teacher_lastname,', ',teachers.teacher_firstname,' ',teachers.teacher_middlename) as teacher_name"))
                ->join('subjects', 'assigns.subject_id', 'subjects.id')
                ->join('teachers', 'assigns.teacher_id', 'teachers.id')
                ->where('section_id', Auth::user()->section->id)
                ->where('term', $term)
                ->where('school_year_id', Helper::activeAY()->id)
                ->get()
        );
    }

    public function saveAssignSubject(Request $request)
    {
        if (isset($request->id)) {
            $isSubjectisExist =  Assign::whereNotIn('id', [$request->id])->where([['section_id', Auth::user()->section->id], ['subject_id', $request->subject_id], ['school_year_id', Helper::activeAY()->id]])->exists();
            if (!$isSubjectisExist) {
                return Assign::where('id', $request->id)->update([
                    'grade_level' => Auth::user()->section->grade_level,
                    'school_year_id' => Helper::activeAY()->id,
                    'section_id' => Auth::user()->section->id,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $request->teacher_id,
                    'term' => $request->term_assign,
                ]);
            } else {
                return response()->json(['warning' => "Subject is already exist!"]);
            }
        } else {
            $isSubjectisExist =  Assign::where([['section_id', Auth::user()->section->id], ['subject_id', $request->subject_id], ['school_year_id', Helper::activeAY()->id]])->exists();
            if (!$isSubjectisExist) {
                return Assign::create([
                    'grade_level' => Auth::user()->section->grade_level,
                    'school_year_id' => Helper::activeAY()->id,
                    'section_id' => Auth::user()->section->id,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $request->teacher_id,
                    'term' => $request->term_assign,
                ]);
            } else {
                return response()->json(['warning' => "Subject is already exist!"]);
            }
        }
    }
    public function assignEdit(Assign $assign)
    {
        return response()->json($assign);
    }

    public function assignDelete(Assign $assign)
    {
        return $assign->delete();
    }

    //GRADING SHS-----------------------------
    public function grading()
    {
        return view('teacher/grading/grading-shs');
    }


    public function loadMySection()
    {
        return response()->json(
            Assign::select('sections.section_name', 'sections.id', 'subjects.descriptive_title', 'assigns.subject_id', 'assigns.term')
                ->join('teachers', 'assigns.teacher_id', 'teachers.id')
                ->join('sections', 'assigns.section_id', 'sections.id')
                ->join('subjects', 'assigns.subject_id', 'subjects.id')
                ->join('school_years', 'assigns.school_year_id', 'school_years.id')
                ->where('school_years.status', 1)
                ->whereBetween('assigns.grade_level', [11, 12])
                ->where('teachers.id', Auth::user()->id)
                ->get()
        );
    }

    public function insertStudentInToGradeTable($section, $subject)
    {
        // insert and protect data duplication
        $toGradeStudentID =  Enrollment::select('student_id')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            ->whereNotIn(
                'student_id',
                Grade::select('student_id')
                    ->where('subject_id', $subject)
                    ->pluck('student_id')->toArray()
            )->where('enrollments.enroll_status', 'Enrolled')
            ->where('enrollments.section_id', $section)
            ->where('status', 1)
            ->get();

        if (!empty($toGradeStudentID)) {
            foreach ($toGradeStudentID as $value) {
                $value['student_id'];
                Grade::create([
                    'student_id' => $value['student_id'],
                    'subject_id' => $subject,
                    'section_id' => $section
                ]);
            }
        }
    }
    public function loadMyStudent($section, $subject,$term)
    {
        return response()->json([
            'data' => Grade::select(
                "students.id as sid",
                "grades.id as gid",
                "grades.first",
                "grades.second",
                "grades.avg",
                "subjects.descriptive_title",
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )->join('students', 'grades.student_id', 'students.id')
                ->join('enrollments', 'grades.student_id', 'enrollments.student_id')
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->join('subjects', 'grades.subject_id', 'subjects.id')
                ->where('enrollments.enroll_status', "Enrolled")
                ->where('enrollments.term', $term)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->where('subjects.id', $subject)
                ->where('sections.id', $section)
                ->get()
        ]);
    }

    public function showStudentEnrolledSUbject($student, $term)
    {
        return Grade::select('grades.id', 'grades.subject_id', 'subjects.descriptive_title')
            ->join('students', 'grades.student_id', 'students.id')
            ->join('subjects', 'grades.subject_id', 'subjects.id')
            ->join('enrollments', 'students.id', 'enrollments.student_id')
            ->leftjoin('assigns', 'grades.subject_id', 'assigns.subject_id')
            ->where('enrollments.term', $term)
            ->where('assigns.term', $term)
            ->where('students.id', $student)
            ->where('enrollments.school_year_id', Helper::activeAY()->id)
            ->get();
    }

    public function saveStudentEnrolledSUbject(Request $request)
    {
        $activeTerm = $this->activeTerm();
        return Grade::create([
            'student_id' => $request->student_id,
            'subject_id' => $request->assign_subject_id,
            'section_id' => Auth::user()->section->id,
            'term' => $activeTerm
        ]);
    }

    public function deleteStudentEnrolledSUbject(Grade $grade)
    {
        return $grade->delete();
    }
}
