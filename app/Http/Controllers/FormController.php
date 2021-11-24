<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Helpers\Helper;
use App\Models\Enrollment;
use App\Models\SchoolProfile;
use App\Models\Strand;
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


    public function nameReq($classfy,$request){
        if (!empty($request)) {
            $name = time().rand(1000,10000).rand(1000,10000).'_'.$classfy.'.'.$request->getClientOriginalExtension();
            // $filePath = $request->storeAs('public/requirements', $name);
            // $file->name = time().'_'.$request->file->getClientOriginalName();
            $destinationPath = public_path('image/requirements');
            $request->move($destinationPath,$name);
            return 'image/requirements/' . $name;
        } else {
            return null;
        }
        
    }

    public function store(Request $request)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['warning' => 'No Academic Year Active']);
        } else {
            $yesGotFound = Student::where('roll_no', $request->roll_no)->exists();
            if ($yesGotFound) {
                $id = Student::where('roll_no', $request->roll_no)->first();
                return $this->preEnroll($id, $request);
            } else {
                $newId = Student::create([
                    'roll_no' => $request->roll_no,
                    //'curriculum' => $request->curriculum,
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
                   // 'last_school_attended' => $request->last_school_attended,
                    'last_schoolyear_attended' => $request->last_schoolyear_attended,
                    'isbalik_aral' => !empty($request->last_schoolyear_attended) ? 'Yes' : 'No',
                    'mother_name' => Str::title($request->mother_name),
                    'mother_contact_no' => $request->mother_contact_no,
                    'father_name' => Str::title($request->father_name),
                    'father_contact_no' => $request->father_contact_no,
                    'guardian_name' => Str::title($request->guardian_name),
                    'guardian_contact_no' => $request->guardian_contact_no,
                    'req_grade' => $this->nameReq('grade',$request->req_grade),
                    'req_psa' => $this->nameReq('psa',$request->req_psa),
                    'req_goodmoral' => $this->nameReq('goodmoral',$request->req_goodmoral),
                    'username' => Helper::create_username($request->student_firstname, $request->student_lastname),
                ]);
                return $this->preEnroll($newId->id, $request);
            }
        }
    }

    public function updateCompleter($id, $completer)
    {
        return Student::whereId($id)->update(['completer' => $completer]);
    }

    public function preEnroll($id, $request)
    {
        $tracking_no = rand(99, 1000) . '-' . rand(99, 1000);

        switch ($request->status) {
            case 'new':
                Enrollment::create([
                    'student_id' => $id,
                    'section_id' => null,
                    'grade_level' => '7',
                    'school_year_id' => Helper::activeAY()->id,
                    'date_of_enroll' => date("d/m/Y"),
                    'enroll_status' => 'Pending',
                    'curriculum' => $request->curriculum,
                    'last_school_attended' => $request->last_school_attended,
                    'student_type' => 'JHS',
                    'tracking_no' => $tracking_no,
                    'state' => 'New',
                ]);
                $this->updateCompleter($id, "No");
                return $tracking_no;
                break;

            case 'new_eleven':
                Enrollment::create([
                    'student_id' => $id,
                    'section_id' => null,
                    'grade_level' => '11',
                    'strand_id' => $request->strand,
                    'school_year_id' => Helper::activeAY()->id,
                    'last_school_attended' => $request->last_school_attended,
                    'date_of_enroll' => date("d/m/Y"),
                    'enroll_status' => 'Pending',
                    'curriculum' => null,
                    'student_type' => 'SHS',
                    'term' => '1st',
                    'tracking_no' => $tracking_no,
                    'state' => 'New',
                ]);
                $this->updateCompleter($id, "Yes");
                return $tracking_no;
                break;
            case 'transferee':
                Enrollment::create([
                    'student_id' => $id,
                    'section_id' => null,
                    'grade_level' => empty($request->grade_level) ? '7' : $request->grade_level,
                    'school_year_id' => Helper::activeAY()->id,
                    'date_of_enroll' => date("d/m/Y"),
                    'enroll_status' => 'Pending',
                    'strand_id' => $request->strand,
                    'last_school_attended' => $request->last_school_attended,
                    'curriculum' => $request->curriculum,
                    'student_type' => (intval($request->grade_level) >= 11) ? 'SHS' : 'JHS',
                    'term' => (intval($request->grade_level) > 10) ? '1st' : null,
                    'tracking_no' => $tracking_no,
                    'state' => Str::title($request->status),
                ]);
                $this->updateCompleter($id, (intval($request->grade_level) >= 11) ? 'Yes' : 'No');
                return $tracking_no;
                break;
            case 'balikAral':
                Enrollment::create([
                    'student_id' => $id,
                    'section_id' => null,
                    'strand_id' => (intval($request->grade_level) >= 11) ? $request->strand : null,
                    'grade_level' =>  $request->grade_level,
                    'school_year_id' => Helper::activeAY()->id,
                    'date_of_enroll' => date("d/m/Y"),
                    'enroll_status' => 'Pending',
                    'last_school_attended' => $request->last_school_attended,
                    'curriculum' => $request->curriculum,
                    'student_type' => (intval($request->grade_level) >= 11) ? 'SHS' : 'JHS',
                    'term' => (intval($request->grade_level) >= 11) ? '1st' : null,
                    'tracking_no' => $tracking_no,
                    'state' => Str::title($request->status),
                ]);
                $this->updateCompleter($id, (intval($request->grade_level) >= 11) ? 'Yes' : 'No');
                return $tracking_no;
                break;
            default:
                # code...
                break;
        }
    }

    public function checkLRN($lrn)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['warning' => 'No Academic Year Active']);
        } else {
            // $isLRN = Student::where('roll_no', $lrn)->exists();
            $isLRN = Enrollment::select('students.roll_no', 'enrollments.school_year_id')
                ->join('students', 'enrollments.student_id', 'students.id')
                ->where('school_year_id', Helper::activeAY()->id)
                ->where('students.roll_no', $lrn)->exists();
            if ($isLRN) {
                return response()->json(['warning' => 'You are already Pre-Enrolled']);
            }
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

    public function strandListForm()
    {
        return Strand::select('id', 'description')->get();
    }
}
