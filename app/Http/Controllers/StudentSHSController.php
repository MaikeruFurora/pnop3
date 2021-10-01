<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentSHSController extends Controller
{
    use Traits\StudentStatus;

    public function grade()
    {
        return view('student/grade-shs');
    }

    public function gradeList($level, $section)
    {
        return response()->json(
            Grade::select(
                "grades.id as gid",
                "grades.first",
                "grades.second",
                "grades.third",
                "grades.fourth",
                "grades.avg",
                "subjects.descriptive_title",
                DB::raw("CONCAT(teachers.teacher_lastname,', ',teachers.teacher_firstname,' ',teachers.teacher_middlename) as fullname")
            )->join('students', 'grades.student_id', 'students.id')
                ->join('subjects', 'grades.subject_id', 'subjects.id')
                ->leftjoin('assigns', 'grades.subject_id', 'assigns.subject_id')
                ->leftjoin('teachers', 'assigns.teacher_id', 'teachers.id')
                ->where('grades.student_id', Auth::user()->id)
                ->where('grades.section_id', $section)
                ->where('assigns.section_id', $section)
                ->get()
        );
    }

    public function levelList()
    {
        return response()->json(
            Enrollment::select('enrollments.grade_level', 'school_years.status', 'sections.section_name', 'enrollments.section_id', 'enrollments.term')
                ->join('students', 'enrollments.student_id', 'students.id')
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
                ->where('students.id', Auth::user()->id)
                ->groupBy('enrollments.grade_level', 'school_years.status', 'sections.section_name', 'enrollments.section_id', 'enrollments.term')
                ->orderBy('school_years.status', 'desc')
                ->get()
        );
    }

    public function enrollment()
    {
        $dataArr = array();
        $activeTerm = $this->activeTerm();
        $ifexist = Enrollment::join('students', 'enrollments.student_id', 'students.id')
            ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
            ->leftjoin('strands', 'enrollments.strand_id', 'strands.id')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            ->where('school_years.status', 1)
            ->where('enrollments.term', $activeTerm)
            ->where('students.id', Auth::user()->id)
            ->first();

        if ($ifexist) {
            $dataArr['status'] = $ifexist->enroll_status;
            $dataArr['term'] = $ifexist->term . ' Term';
            $dataArr['active_term'] = $activeTerm;
        } else {
            $dataArr['status'] = 'Ongoing';
            $dataArr['term'] = 'N/A';
            $dataArr['active_term'] = $activeTerm;
        }
        $eStatus = $this->enrollStatus();

        return view('student/enrollment-shs', compact('eStatus', 'dataArr'));
    }

    public function checkSubjectBalance(Student $student)
    {
        return Grade::where('student_id', $student->id)->WhereNull('avg')->orWhere('avg', '')->get()->count();
    }
}
