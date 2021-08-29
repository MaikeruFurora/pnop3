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

    use Traits\StudentStatus;

    public function dashboard()
    {
        $enrolledData = Enrollment::join('students', 'enrollments.student_id', 'students.id')
            ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            ->where('school_years.status', 1)
            ->where('students.id', Auth::user()->id)
            ->first();
        return view('student/dashboard', compact('enrolledData'));
    }

    public function store(Request $request)
    {
        if (isset($request->id)) {
            $dataret = Student::findOrFail($request->id);
        }
        return Student::updateOrCreate(['id' => $request->id], [
            'roll_no' => $request->roll_no,
            'curriculum' => empty($dataret->curriculum) ? $request->curriculum : $dataret->curriculum,
            'student_firstname' => $request->student_firstname,
            'student_middlename' => $request->student_middlename,
            'student_lastname' => $request->student_lastname,
            'date_of_birth' => $request->date_of_birth,
            'student_contact' => $request->student_contact,
            'gender' => $request->gender,
            'region' => empty($request->region) ? $request->region : $dataret->region,
            'province' => empty($request->province) ? $request->province : $dataret->province,
            'city' => empty($request->city) ? $request->city : $dataret->city,
            'barangay' => empty($request->barangay) ? $request->barangay : $dataret->barangay,
            'last_school_attended' => $request->last_school_attended,
            'last_schoolyear_attended' => $request->last_schoolyear_attended,
            'isbalik_aral' => !empty($request->last_schoolyear_attended) ? 'Yes' : 'No',
            'mother_name' => $request->mother_name,
            'mother_contact_no' => $request->mother_contact_no,
            'father_name' => $request->father_name,
            'father_contact_no' => $request->father_contact_no,
            'guardian_name' => $request->guardian_name,
            'guardian_contact_no' => $request->guardian_contact_no,
            'username' => empty($dataret->username) ? Helper::create_username($request->student_firstname, $request->student_lastname) : $dataret->username,
            'orig_password' => empty($dataret->orig_password) ? Crypt::encrypt("pnhs") : $dataret->orig_password,
            'password' => empty($dataret->password) ? Hash::make("pnhs") : $dataret->password,
            'student_status' => null,
        ]);
    }

    public function edit(Student $student)
    {
        return response()->json($student);
    }

    public function list()
    {
        $data = array();
        $sqlData = Student::select("*")->whereNotNull('orig_password')->get();
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


    public function gradeList($level)
    {


        // return Enrollment::with('student', 'section')->where('enrollments.student_id', Auth::user()->id)->get();
        return response()->json(
            Grade::select(
                "grades.id as gid",
                "grades.first",
                "grades.second",
                "grades.third",
                "grades.fourth",
                "grades.avg",
                "subjects.descriptive_title",
                "enrollments.grade_level",
                "sections.section_name",
            )->join('students', 'grades.student_id', 'students.id')
                ->join('subjects', 'grades.subject_id', 'subjects.id')
                ->join('enrollments', 'grades.student_id', 'enrollments.student_id')
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->where('students.id', Auth::user()->id)
                ->where('enrollments.grade_level', $level)
                ->get()
            // ->groupBy('enrollments.grade_level')
        );


        // return Enrollment::select('enrollments.grade_level', 'sections.section_name', 'grades.first', 'grades.second', 'grades.third')
        //     ->join('students', 'enrollments.student_id', 'students.id')
        //     ->join('sections', 'enrollments.section_id', 'sections.id')
        //     ->join('grades', 'enrollments.student_id', 'grades.student_id')
        //     ->join('subjects', 'grades.subject_id', 'subjects.id')
        //     ->where('students.id', Auth::user()->id)
        //     // ->groupBy('enrollments.grade_level',)
        //     ->get();
    }

    public function levelList()
    {
        return response()->json(
            Enrollment::select('enrollments.grade_level', 'school_years.status', 'sections.section_name')
                ->join('students', 'enrollments.student_id', 'students.id')
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
                ->where('students.id', Auth::user()->id)
                ->groupBy('enrollments.grade_level', 'school_years.status', 'sections.section_name')
                ->orderBy('enrollments.grade_level', 'asc')
                ->get()
        );
    }

    public function enrollment()
    {
        $eStatus = $this->enrollStatus();
        return view('student/enrollment', compact('eStatus'));
    }


    public function viewRecord(Student $student)
    {
        return view('administrator/masterlist/student/record', compact('student'));
    }

    public function backsubject()
    {
        return view('student/backsubject');
    }
}
