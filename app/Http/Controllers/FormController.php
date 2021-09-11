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

    use Traits\AuthAccess;

    public function welcome()
    {
        return $this->authority('form/welcome');
    }

    public function form()
    {
        return $this->authority('form/form');
    }

    public function done($tracking)
    {
        return $this->authority('form/done', $tracking);
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
                'last_schoolyear_attended' => $request->last_schoolyear_attended,
                'isbalik_aral' => !empty($request->last_schoolyear_attended) ? 'Yes' : 'No',
                'mother_name' => Str::title($request->mother_name),
                'mother_contact_no' => $request->mother_contact_no,
                'father_name' => Str::title($request->father_name),
                'father_contact_no' => $request->father_contact_no,
                'guardian_name' => Str::title($request->guardian_name),
                'guardian_contact_no' => $request->guardian_contact_no,
                'username' => Helper::create_username($request->student_firstname, $request->student_lastname),

            ]);
            $tracking_no = rand(99, 1000) . '-' . rand(99, 1000);
            Enrollment::create([
                'student_id' => $student->id,
                'section_id' => null,
                'grade_level' => empty($request->grade_level) ? '7' : $request->grade_level,
                'school_year_id' => Helper::activeAY()->id,
                'date_of_enroll' => date("d/m/Y"),
                'enroll_status' => 'Pending',
                'curriculum' => $request->curriculum,
                'student_type' => (intval($request->grade_level) > 10) ? 'SHS' : 'JHS',
                'tracking_no' => $tracking_no,
                'state' => 'New',
            ]);
            return $tracking_no;
        }
    }

    public function checkLRN($lrn)
    {
        $isLRN = Student::where('roll_no', $lrn)->exists();
        if ($isLRN) {
            return response()->json(['warning' => 'You are already Enrolled']);
        }
    }

    public function authority($viewFile, $data = null)
    {
        $school = SchoolProfile::find(1);
        if ($data == null) {
            if ($school->school_enrollment_url) {
                return view($viewFile);
            } else {
                return $this->forbidden();
            }
        } else {
            if ($school->school_enrollment_url) {
                return view($viewFile, compact('data'));
            } else {
                return $this->forbidden();
            }
        }
    }
}
