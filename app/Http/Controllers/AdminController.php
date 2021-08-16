<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SchoolProfile;
use App\Models\SchoolYear;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str as SupportStr;

class AdminController extends Controller
{


    public function dashboard()
    {

        return view('administrator/dashboard');
    }
    public function admission()
    {

        return view('administrator/enrollment/admission');
    }
    public function enrollment()
    {

        return view('administrator/enrollment/enrollment');
    }
    public function teacher()
    {

        return view('administrator/masterlist/teacher');
    }
    public function student()
    {

        return view('administrator/masterlist/student');
    }

    public function profile()
    {
        $data = SchoolProfile::find(1);
        return view('administrator/management/profile', compact('data'));
    }

    public function section()
    {
        $academicYear = SchoolYear::all();
        $teachers = Teacher::all();
        return view('administrator/management/section', compact('teachers', 'academicYear'));
    }

    public function subject()
    {
        $teachers = Teacher::all();
        return view('administrator/management/subject', compact('teachers'));
    }

    public function schedule()
    {
        $teachers = Teacher::all();
        return view('administrator/management/schedule', compact('teachers'));
    }

    public function assign()
    {
        $teachers = Teacher::all();
        return view('administrator/management/assign', compact('teachers'));
    }

    public function chairman()
    {
        $teachers = Teacher::all();
        return view('administrator/management/chairman', compact('teachers'));
    }

    public function academicYear()
    {
        return view('administrator/management/academic-year');
    }



    public function storeProfile(Request $request)
    {
        $data = $request->validate([
            'school_name' => 'required',
            'school_id_no' => 'required',
            'school_address' => 'required',
            'school_division' => 'required',
            'school_region' => 'required',
            // 'school_logo' => '',
        ]);

        if ($request->hasFile('school_logo')) {
            $image = $request->file('school_logo');
            $imageName = SupportStr::of($request->school_name)->slug('-') . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image/logo'), $imageName);
            $data["school_logo"] = $imageName;
        } else {
            $resData = SchoolProfile::find($request->id);
            $data["school_logo"] = !empty($resData->school_logo) ? $resData->school_logo : null;
        }

        return SchoolProfile::updateOrCreate(['id' => $request->id], $data);
    }

    public function storeAY(Request $request)
    {

        // $data = SchoolYear::where('to', '>', $request->to)->get()->count();
        // if ($data) {
        //     return true;
        // } else {
        // SchoolYear::where('id', '>', 0)->update(['status' => 0]);
        return SchoolYear::updateOrCreate(['id' => $request->id], $request->all());
        // }
    }

    public function listAY()
    {
        return response()->json(['data' => SchoolYear::orderBy('to', 'asc')->get()]);
    }

    public function changeAY($id)
    {
        SchoolYear::where('id', '>', 0)->update(['status' => 0]);
        return SchoolYear::where('id', $id)->update(['status' => 1]);
    }

    public function deleteAY($id)
    {
        return SchoolYear::where([['status', 0], ['id', $id]])->delete();
    }

    public function editAY(SchoolYear $schoolYear)
    {
        return response()->json($schoolYear);
    }
}
