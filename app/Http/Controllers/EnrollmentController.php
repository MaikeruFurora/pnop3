<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Enrollment;
use App\Models\Grade;
use App\Models\SchoolProfile;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EnrollmentController extends Controller
{
    public function changeStatus(Request $request)
    {

        // return $request->value;
        SchoolProfile::where('id', $request->id)
            ->update([
                'school_enrollment_url' => $request->value == 'yes' ? true : false
            ]);
    }
    public function masterList($level)
    {
        if ($level == "all") {
            $data = Enrollment::select(
                "enrollments.*",
                "roll_no",
                "students.curriculum",
                "students.isbalik_aral",
                "students.last_schoolyear_attended",
                "sections.section_name",
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )->orderBy('sections.section_name')
                ->join('students', 'enrollments.student_id', 'students.id')
                ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
                ->where('school_years.status', 1)
                ->get();
        } else {
            $data = Enrollment::select(
                "enrollments.*",
                "roll_no",
                "students.curriculum",
                "students.isbalik_aral",
                "students.last_schoolyear_attended",
                "sections.section_name",
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )->orderBy('sections.section_name')
                ->join('students', 'enrollments.student_id', 'students.id')
                ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
                ->where('school_years.status', 1)
                ->where('enrollments.grade_level', $level)
                ->get();
        }

        return response()->json(['data' => $data]);
    }

    public function enrolledSubject($enrolled)
    {
        $enrolledSubject = Enrollment::select('enrollments.student_id', 'enrollments.grade_level', 'students.curriculum')
            ->join('students', 'enrollments.student_id', 'students.id')
            ->where('enrollments.id', $enrolled)
            ->where('school_year_id', Helper::activeAY()->id)->first();
        $subjects = Subject::where('grade_level', $enrolledSubject->grade_level)->whereIn('subject_for', [$enrolledSubject->curriculum, 'GENERAL'])->get();

        foreach ($subjects as $subject) {

            Grade::create([
                'student_id' => $enrolledSubject->student_id,
                'subject_id' => $subject->id
            ]);
        }
    }
    public function store(Request $request)
    {

        if (Auth::user()->chairman->grade_level == 7) {
            $student = $this->storeStudenRequest($request);
            $enrolled = Enrollment::create([
                'student_id' => $student->id,
                'section_id' => $request->section_id,
                'grade_level' => empty($request->grade_level) ? '7' : $request->grade_level,
                'school_year_id' => Helper::activeAY()->id,
                'date_of_enroll' => date("d/m/Y"),
                'enroll_status' => empty($request->section_id) ? 'Pending' : 'Enrolled',
            ]);
            return $this->enrolledSubject($enrolled->id);
        } else {
            if ($request->status == "upperclass") {
                $student = Student::where('roll_no', $request->roll_no)->first();
                return Enrollment::create([
                    'student_id' => $student->id,
                    'section_id' => $request->section_id,
                    'grade_level' => $request->grade_level,
                    'school_year_id' => Helper::activeAY()->id,
                    'date_of_enroll' => date("d/m/Y"),
                    'enroll_status' => 'Pending',
                ]);
            } elseif ($request->status = "transferee") {
                $student = $this->storeStudenRequest($request);
                return Enrollment::create([
                    'student_id' => $student->id,
                    'section_id' => $request->section_id,
                    'grade_level' => $request->grade_level,
                    'school_year_id' => Helper::activeAY()->id,
                    'date_of_enroll' => date("d/m/Y"),
                    'enroll_status' => empty($request->section_id) ? 'Pending' : 'Enrolled',
                ]);
            } else {
                return false;
            }
        }
    }

    public function storeStudenRequest($request)
    {
        return  Student::create([
            'roll_no' => $request->roll_no,
            'curriculum' => $request->curriculum,
            'student_firstname' => Str::title($request->student_firstname),
            'student_middlename' => Str::title($request->student_middlename),
            'student_lastname' => Str::title($request->student_lastname),
            'date_of_birth' => $request->date_of_birth,
            'student_contact' => $request->student_contact,
            'gender' => $request->gender,
            'region' => $request->region,
            'province' => $request->province,
            'city' => $request->city,
            'barangay' => $request->barangay,
            'last_school_attended' => $request->last_school_attended,
            'last_schoolyear_attended' => $request->last_schoolyear_attended,
            'isbalik_aral' => !empty($request->last_schoolyear_attended) ? 'yes' : 'no',
            'mother_name' => Str::title($request->mother_name),
            'mother_contact_no' => $request->mother_contact_no,
            'father_name' => Str::title($request->father_name),
            'father_contact_no' => $request->father_contact_no,
            'guardian_name' => Str::title($request->guardian_name),
            'guardian_contact_no' => $request->guardian_contact_no,
            'username' => Helper::create_username($request->student_firstname, $request->student_lastname),
            'orig_password' => Crypt::encrypt("pnhs"),
            'password' => Hash::make("pnhs"),
        ]);
    }

    public function edit($enrollment)
    {
        return response()->json(
            Enrollment::select(
                'enrollments.*',
                'enrollments.section_id',
                "students.student_firstname",
                "students.student_middlename",
                "students.student_lastname",
            )->join('students', 'enrollments.student_id', 'students.id')
                ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                ->where('enrollments.id', $enrollment)->first()
        );
    }

    public function destroy($enrollment)
    {
        $enroll = Enrollment::join('students', 'enrollments.student_id', 'students.id')->where('enrollments.id', $enrollment)->first();
        $subjects = Subject::where('grade_level', $enroll->grade_level)->whereIn('subject_for', [$enroll->curriculum, 'GENERAL'])->get();
        foreach ($subjects as $subject) {
            Grade::where('student_id', $enroll->student_id)->whereIn('subject_id', [$subject->id])->delete();
        }
        Enrollment::find($enrollment)->delete();
        if (Auth::user()->chairman->grade_level == 7) {
            Student::where('id', $enroll->student_id)->delete();
            Student::where('id', $enroll->student_id)->withTrashed()->first()->forceDelete();
        }
    }

    public function checkLRN($lrn, $curriculum)
    {

        if (Auth::user()->chairman->grade_level == 7) {
            //grade 7 only
            $isLRN = Student::where('roll_no', $lrn)->exists();
            if ($isLRN) {
                return response()->json(['warning' => 'This student are already Enrolled']);
            }
        } else {
            //grade 8-10 only
            $student = Enrollment::join('students', 'enrollments.student_id', 'students.id')
                ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
                ->where('school_years.status', 1)
                ->where('roll_no', $lrn)->exists();
            // determin where grade level inrolled
            $findStudentGL = Enrollment::join('students', 'enrollments.student_id', 'students.id')
                ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
                ->where('school_years.status', 1)
                ->where('roll_no', $lrn)
                ->first();
            if ($student) {
                return response()->json(['warning' => 'You are already Enrolled in ' . $findStudentGL->curriculum . ' curriculum <br> grade ' . $findStudentGL->grade_level . ' student']);
            } else {
                $isAlreadyinMasterlist = Student::where('roll_no', $lrn)->where('curriculum', $curriculum)->exists();
                $findStudent = Student::where('students.roll_no', $lrn)->first();
                if ($isAlreadyinMasterlist) {
                    //get all stundent information
                    return response()->json([
                        'student' => $findStudent
                    ]);
                } else {
                    //if curriculum is not belong to the chairman enrollment form!!!
                    return response()->json(['warning' => '
                    This student is not enrolled in this program (curriculum), <br>and his or her curriculum is  included to <b>' . $findStudent->curriculum . '</b>']);
                }
            }
        }
    }

    public function filterSection($curriculum)
    {
        return response()->json(Section::where("grade_level", auth()->user()->chairman->grade_level)
            ->where("class_type", $curriculum)
            ->get());
    }

    public function setSection(Request $request)
    {
        $totalStudentInSection = Enrollment::where("section_id", $request->section)->where('school_year_id', Helper::activeAY()->id)->count();
        if ($request->status_now == 'force') {
            if ($totalStudentInSection >= 5) {
                return response()->json(['warning' => 'This section reach the maximum number of student']);
            } else {

                Enrollment::where('id', $request->enroll_id)
                    ->where('school_year_id', Helper::activeAY()->id)
                    ->update([
                        'section_id' => $request->section,
                        'enroll_status' => 'Enrolled',
                    ]);

                return $this->enrolledSubject($request->enroll_id);
            }
        } else {
            if ($totalStudentInSection >= 3) {
                return response()->json(['warning' => 'Section is full']);
            } else {

                Enrollment::where('id', $request->enroll_id)
                    ->where('school_year_id', Helper::activeAY()->id)
                    ->update([
                        'section_id' => $request->section,
                        'enroll_status' => 'Enrolled',
                    ]);

                return $this->enrolledSubject($request->enroll_id);
                // $enrolledSubject = Enrollment::select('enrollments.grade_level', 'students.curriculum')
                //     ->join('students', 'enrollments.student_id', 'students.id')
                //     ->where('id', $request->enroll_id)
                //     ->where('school_year_id', Helper::activeAY()->id)->first();
                // $subjects = Subject::where('grade_level', $enrolledSubject->grade_level)->where('subject_for', $enrolledSubject->curriculum)->get();
                // // $leftsubject = Student::where('curriculum',)
                // foreach ($subjects as $subject) {

                //     Grade::create([
                //         'student_id' => $enrolledSubject->student_id,
                //         'subject_id' => $subject->id
                //     ]);
                // }
            }
        }
    }

    public function myClass()
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
                ->whereIn('enrollments.enroll_status', ['Enrolled', 'Dropped'])
                ->orderBy('students.student_lastname')
                ->get()
        ]);
    }

    public function dropped(Enrollment $enrollment)
    {
        $enrollment->enroll_status = ($enrollment->enroll_status == 'Dropped') ? 'Enrolled' : 'Dropped';
        $enrollment->date_of_enroll = date("d/m/Y");
        return $enrollment->save();
    }
}
