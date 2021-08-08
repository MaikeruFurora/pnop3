<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function dashboard()
    {
        return view('teacher/dashboard');
    }



    // administrator Control Functionalities

    public function list()
    {
        $data = array();
        $sqlData = Teacher::select("*")->get();
        foreach ($sqlData as $key => $value) {
            $arr = array();
            $arr['id'] = $value->id;
            $arr['roll_no'] = $value->roll_no;
            $arr['teacher_firstname'] = $value->teacher_firstname;
            $arr['teacher_middlename'] = $value->teacher_middlename;
            $arr['teacher_lastname'] = $value->teacher_lastname;
            $arr['teacher_gender'] = $value->teacher_gender;
            $arr['username'] = $value->username;
            $arr['orig_password'] = Crypt::decrypt($value->orig_password);
            $data[] = $arr;
        }
        // return $data;
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
        ]);

        if (isset($request->id)) {
            $dataret = Teacher::findOrFail($request->id);
        }
        $dataPass = Helper::create_password(7);
        return Teacher::updateorcreate(['id' => $request->id], [
            'teacher_firstname' => Str::title($request->firstname),
            'teacher_middlename' => Str::title($request->middlename),
            'teacher_lastname' => Str::title($request->lastname),
            'teacher_gender' => $request->gender,
            'roll_no' => empty($dataret->roll_no) ? Helper::create_roll_no() : $dataret->roll_no,
            'username' => empty($dataret->username) ? Helper::create_username($request->firstname, $request->lastname) : $dataret->username,
            'orig_password' => empty($dataret->orig_password) ? Crypt::encrypt($dataPass) : $dataret->orig_password,
            'password' => empty($dataret->password) ? Hash::make($dataPass) : $dataret->password,
        ]);
    }

    public function delete($id)
    {
        return Teacher::findOrFail($id)->delete();
    }
    public function edit(Teacher $teacher)
    {
        return response()->json($teacher);
    }
}
