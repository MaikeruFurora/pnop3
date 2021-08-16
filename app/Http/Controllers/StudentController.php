<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student/dashboard');
    }

    public function store(Request $request)
    {
        if (isset($request->id)) {
            $dataret = Student::findOrFail($request->id);
        }
        $address = ucwords(strtolower($request->barangay) . ", " . strtolower($request->city) . ", " . strtolower($request->province));
        $dataPass = Helper::create_password(7);
        return Student::create([
            'roll_no' => $request->roll_no,
            'student_type' => $request->student_type,
            'student_firstname' => $request->student_firstname,
            'student_middlename' => $request->student_middlename,
            'student_lastname' => $request->student_lastname,
            'date_of_birth' => $request->date_of_birth,
            'student_contact' => $request->student_contact,
            'gender' => $request->gender,
            'martial_status' => $request->martial_status,
            'address' => $address,
            'mother_name' => $request->mother_name,
            'mother_contact_no' => $request->mother_contact_no,
            'father_name' => $request->father_name,
            'father_contact_no' => $request->father_contact_no,
            'guardian_name' => $request->guardian_name,
            'guardian_contact_no' => $request->guardian_contact_no,
            'username' => empty($dataret->username) ? Helper::create_username($request->student_firstname, $request->student_lastname) : $dataret->username,
            'orig_password' => empty($dataret->orig_password) ? Crypt::encrypt($dataPass) : $dataret->orig_password,
            'password' => empty($dataret->password) ? Hash::make($dataPass) : $dataret->password,
            'student_status' => null,
        ]);
    }

    public function list()
    {
        $data = array();
        $sqlData = Student::select("*")->get();
        foreach ($sqlData as $key => $value) {
            $arr = array();
            $arr['id'] = $value->id;
            $arr['roll_no'] = $value->roll_no;
            $arr['student_firstname'] = $value->student_firstname;
            $arr['student_middlename'] = $value->student_middlename;
            $arr['student_lastname'] = $value->student_lastname;
            $arr['gender'] = $value->gender;
            $arr['username'] = $value->username;
            $arr['orig_password'] = Crypt::decrypt($value->orig_password);
            $data[] = $arr;
        }
        // return $data;
        return response()->json(['data' => $data]);
    }

    public function profile(Student $student)
    {
        return view('student/profile', compact('student'));
    }

    public function grade()
    {
        return view('student/grade');
    }
}
