<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Helpers\Helper;
use App\Models\Enrollment;
use App\Models\SchoolProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function welcome()
    {
        return $this->authority('form/welcome');
    }

    public function form()
    {
        return $this->authority('form/form');
    }

    public function done()
    {
        return $this->authority('form/done');
    }

    public function store(Request $request)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['warning' => 'No Academic Year Active']);
        } else {
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
                'city' => $request->city,
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
                'section_id' => null,
                'grade_level' => empty($request->grade_level) ? '7' : $request->grade_level,
                'school_year_id' => Helper::activeAY()->id,
                'date_of_enroll' => date("d/m/Y"),
                'enroll_status' => 'Pending',
            ]);
        }
    }

    public function checkLRN($lrn)
    {
        $isLRN = Student::where('roll_no', $lrn)->exists();
        if ($isLRN) {
            return response()->json(['warning' => 'You are already Enrolled']);
        }
    }

    public function authority($viewFile)
    {
        $school = SchoolProfile::find(1);
        if ($school->school_enrollment_url) {
            return view($viewFile);
        } else {
            return abort(403);
        }
    }
}
