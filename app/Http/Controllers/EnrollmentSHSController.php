<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Helpers\Helper;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Strand;
use App\Models\{Student,Newassign, SchoolProfile};
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class EnrollmentSHSController extends Controller
{
    public function filterSection($strand)
    {
        return response()->json(
            Section::join('school_years', 'sections.school_year_id', 'school_years.id')
            ->select('sections.section_name', 'sections.id')
            ->where('school_years.status', 1)
            ->where('strand_id', $strand)
            ->where('grade_level',  Auth::user()->chairman_info->grade_level)
            ->get()
        );
    }

    public function walkinEnrollee(Request $request)
    {
        $tracking_no = rand(99, 1000) . '-' . rand(99, 1000);
        $yesFound = Student::where('roll_no', $request->roll_no)->exists();
        if ($yesFound) {
            $getStudentRec = Student::where('students.roll_no', $request->roll_no)->first();
            if (!$this->checkIfAlreadyEnrolled($getStudentRec->id, $request->term_enroll, $request->grade_level)) {
                $this->enrollNow($getStudentRec->id, $request->section_id, $request->strand_id, $tracking_no, $request->term_enroll, $request->grade_level);
                $this->updateCompleter($getStudentRec->id);
                $this->updateUserAccount($getStudentRec->id);
            } else {
                return response()->json(['warning' => 'This student already enrolled']);
            }
        } else {
            $student = $this->storeStudent($request);
            return $this->enrollNow($student, $request->section_id, $request->strand_id, $tracking_no, $request->term_enroll, $request->grade_level);
        }
    }

    public function updateCompleter($id)
    {
        return Student::where('id', $id)->update(['completer' => "Yes"]);
    }
    public function storeStudent($request)
    {
        $stud = Student::create([
            'roll_no' => $request->roll_no,
            'student_firstname' => $request->student_firstname,
            'student_middlename' => $request->student_middlename,
            'student_lastname' => $request->student_lastname,
            'date_of_birth' => $request->date_of_birth,
            'student_contact' => $request->student_contact,
            'gender' => $request->gender,
            'region' =>  $request->region_update,
            'province' =>  $request->province_update,
            'city' =>  $request->city_update,
            'barangay' =>  $request->barangay_update,
            // 'last_school_attended' => $request->last_school_attended,
            'last_schoolyear_attended' => $request->last_schoolyear_attended,
            'isbalik_aral' => !empty($request->last_schoolyear_attended) ? 'Yes' : 'No',
            'mother_name' => $request->mother_name,
            'mother_contact_no' => $request->mother_contact_no,
            'father_name' => $request->father_name,
            'father_contact_no' => $request->father_contact_no,
            'guardian_name' => $request->guardian_name,
            'guardian_contact_no' => $request->guardian_contact_no,
            'username' => Helper::create_username($request->student_firstname, $request->student_lastname),
            'orig_password' => Crypt::encrypt("pnhs"),
            'password' => Hash::make("pnhs"),
            'student_status' => null,
            'completer' => 'Yes',
        ]);
        return $stud->id;
    }

    public function updateUserAccount($student)
    {
        return Student::whereId($student)->update(['orig_password' => Crypt::encrypt("pnhs"), 'password' => Hash::make("pnhs")]);
    }

    public function checkIfAlreadyEnrolled($id, $term, $grade_level)
    {
        return Enrollment::where('student_id', $id)
            ->where('term', $term)
            ->where('grade_level', $grade_level)
            ->exists();
    }

    public function enrollNow($student_id, $section_id, $strand_id, $tracking_no, $term, $grade_level)
    {
        $sp = SchoolProfile::find(1);

        Enrollment::create([
            'student_id' => $student_id,
            'section_id' => $section_id,
            'grade_level' => $grade_level,
            'strand_id' => $strand_id,
            'school_year_id' => Helper::activeAY()->id,
            'date_of_enroll' => date("d/m/Y"),
            'enroll_status' => empty($section_id) ? 'Pending' : 'Enrolled',
            'curriculum' => null,
            'student_type' => 'SHS',
            'term' => $term,
            'tracking_no' => $tracking_no,
            'state' => 'New',
            'last_school_attended' => $sp->last_school_attended,
        ]);
    }

    public function destroy(Enrollment $enrollment)
    {
        return $enrollment->delete();
        // $enroll = Enrollment::join('students', 'enrollments.student_id', 'students.id')->where('enrollments.id', $enrollment)->first();
        // $subjects = Subject::where('grade_level', $enroll->grade_level)->whereIn('subject_for', [$enroll->curriculum, 'GENERAL'])->get();
        // foreach ($subjects as $subject) {
        //     Grade::where('student_id', $enroll->student_id)->whereIn('subject_id', [$subject->id])->delete();
        // }
    }

    public function editEnrollee($enrollment)
    {
        return response()->json(
            Enrollment::select(
                'enrollments.*',
                'enrollments.section_id',
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )->join('students', 'enrollments.student_id', 'students.id')
                ->join('strands', 'enrollments.strand_id', 'strands.id')
                ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                ->where('enrollments.id', $enrollment)->first()
        );
    }

    public function setSection(Request $request)
    {
        $stud_data = Enrollment::select('student_id', 'enroll_status', 'section_id')->whereId($request->enroll_id)->first();
        if ($stud_data->enroll_status == 'Pending') {
            $this->updateUserAccount($stud_data->student_id);
            return  Enrollment::whereId($request->enroll_id)
                ->where('school_year_id', Helper::activeAY()->id)
                ->update([
                    'section_id' => $request->section,
                    'enroll_status' => 'Enrolled',
                ]);
        } else {
            Newassign::where('section_id',$stud_data->section_id)
            ->where('student_id',$stud_data->student_id)
            ->update([
                'section_id'=>$request->section
            ]);
            return  Enrollment::whereId($request->enroll_id)
                ->where('school_year_id', Helper::activeAY()->id)
                ->update([
                    'section_id' => $request->section
                ]);
        }
    }

    // public function enrolled($enroll_id, $section)
    // {
    //     Enrollment::where('id', $enroll_id)
    //         ->where('school_year_id', Helper::activeAY()->id)
    //         ->update([
    //             'section_id' => $section,
    //             'enroll_status' => 'Enrolled',
    //         ]);
    // }
}
