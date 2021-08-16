<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EnrollmentController extends Controller
{
    public function masterList($level)
    {
        return response()->json(
            [
                'data' =>
                Enrollment::select(
                    "enrollments.*",
                    "roll_no",
                    "students.curriculum",
                    "sections.section_name",
                    DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
                )->orderBy('sections.section_name')
                    ->join('students', 'enrollments.student_id', 'students.id')
                    ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                    ->where('enrollments.school_year_id', Helper::activeAY()->id)
                    ->where('enrollments.grade_level', $level)

                    ->get()
            ]
        );
    }
    public function store(Request $request)
    {
        if (Auth::user()->chairman->grade_level == 7) {
            $student = Student::create([
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
                'town' => $request->town,
                'barangay' => $request->barangay,
                'last_school_attended' => $request->last_school_attended,
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

            return Enrollment::create([
                'student_id' => $student->id,
                'section_id' => $request->section_id,
                'grade_level' => empty($request->grade_level) ? '7' : $request->grade_level,
                'school_year_id' => Helper::activeAY()->id,
                'date_of_enroll' => date("d/m/Y"),
                'enroll_status' => 'Enrolled',
            ]);
        } else {
            $student = Student::where('roll_no', $request->roll_no)->first();
            return Enrollment::create([
                'student_id' => $student->id,
                'section_id' => null,
                'grade_level' => $request->grade_level,
                'school_year_id' => Helper::activeAY()->id,
                'date_of_enroll' => date("d/m/Y"),
                'enroll_status' => 'Pending',
            ]);
        }
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

    public function destroy(Enrollment $enrollment)
    {
        return $enrollment->delete();
    }

    public function checkLRN($lrn)
    {
        if (Auth::user()->chairman->grade_level == 7) {
            $isLRN = Student::where('roll_no', $lrn)->exists();
            if ($isLRN) {
                return response()->json(['warning' => 'This student are already Enrolled']);
            }
        } else {
            $student = Student::where('roll_no', $lrn)->get();
            $isHave = Enrollment::where("student_id", $student->id)->where("school_year_id", Helper::activeAY()->id)->exists();
            if ($isHave) {
                return response()->json(['warning' => 'You are already Enrolled']);
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

                return Enrollment::where('id', $request->enroll_id)
                    ->where('school_year_id', Helper::activeAY()->id)
                    ->update([
                        'section_id' => $request->section,
                        'enroll_status' => 'Enrolled',
                    ]);
            }
        } else {
            if ($totalStudentInSection >= 3) {
                return response()->json(['warning' => 'Section is full']);
            } else {

                return Enrollment::where('id', $request->enroll_id)
                    ->where('school_year_id', Helper::activeAY()->id)
                    ->update([
                        'section_id' => $request->section,
                        'enroll_status' => 'Enrolled',
                    ]);
            }
        }
    }
}
