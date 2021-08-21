<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Helpers\Helper;
use App\Models\Enrollment;
use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return Student::updateOrCreate(['id' => $request->id], [
            'roll_no' => $request->roll_no,
            'curriculum' => empty($dataret->curriculum) ? $request->curriculum : $dataret->curriculum,
            'student_firstname' => $request->student_firstname,
            'student_middlename' => $request->student_middlename,
            'student_lastname' => $request->student_lastname,
            'date_of_birth' => $request->date_of_birth,
            'student_contact' => $request->student_contact,
            'gender' => $request->gender,
            'region' => $request->region,
            'province' => $request->province,
            'city' => $request->city,
            'barangay' => $request->barangay,
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
            $arr['student_contact'] = $value->student_contact;
            $arr['gender'] = $value->gender;
            $arr['username'] = $value->username;
            $arr['orig_password'] = Crypt::decrypt($value->orig_password);
            $data[] = $arr;
        }
        // return $data;
        return response()->json(['data' => $data]);
    }

    public function destroy(Student $student)
    {
        return $student->delete();
    }

    public function profile()
    {
        return view('student/profile');
    }

    public function grade()
    {
        return view('student/grade');
    }


    public function gradeList()
    {


        // return Enrollment::with('student', 'section')->where('enrollments.student_id', Auth::user()->id)->get();
        // return response()->json(
        //     Grade::select(
        //         "grades.id as gid",
        //         "grades.first",
        //         "grades.second",
        //         "grades.third",
        //         "grades.fourth",
        //         "grades.avg",
        //         "subjects.descriptive_title",
        //         "enrollments.grade_level",
        //         "sections.section_name",
        //     )->join('students', 'grades.student_id', 'students.id')
        //         ->join('subjects', 'grades.subject_id', 'subjects.id')
        //         ->join('enrollments', 'grades.student_id', 'enrollments.student_id')
        //         ->join('sections', 'enrollments.section_id', 'sections.id')
        //         ->where('students.id', Auth::user()->id)
        //         ->groupBy('enrollments.grade_level')
        //         ->get()
        // );


        return Enrollment::select(
            "grades.first",
            "grades.second",
            "grades.third",
            "grades.fourth",
            "grades.avg",
            "sections.section_name",
            "subjects.descriptive_title",
        )
            ->join('students', 'enrollments.student_id', 'students.id')
            ->join('grades', 'enrollments.student_id', 'grades.student_id')
            ->join('subjects', 'grades.subject_id', 'subjects.id')
            ->join('sections', 'enrollments.section_id', 'sections.id')
            ->where('students.id', Auth::user()->id)
            // ->groupBy('sections.section_name')
            ->get();
    }
}
