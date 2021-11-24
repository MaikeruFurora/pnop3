<?php

namespace App\Http\Controllers;

use App\Models\{BackSubject,Grade};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BackSubjectController extends Controller
{
    public function backsubjectList()
    {
        return response()->json(
            Grade::select('subjects.subject_code','subjects.descriptive_title', 'grades.id', 'subjects.grade_level', 'grades.avg', 'grades.avg_now', 'grades.remarks','grades.conducted_from','grades.conducted_to')
            ->join('students','grades.student_id','students.id')
            ->join('subjects','grades.subject_id','subjects.id')
            ->where('grades.avg','<',75)
            ->where('students.id', auth()->user()->id)
            ->get()
            // BackSubject::select('subjects.descriptive_title', 'back_subjects.id', 'back_subjects.grade_level', 'back_subjects.prev_avg', 'back_subjects.avg_now', 'back_subjects.remarks')
            //     ->join('students', 'back_subjects.student_id', 'students.id')
            //     ->join('subjects', 'back_subjects.subject_id', 'subjects.id')
            //     ->where('students.id', Auth::user()->id)
            //     ->get()
        );
    }

    public function backrecordList()
    {
        return response()->json(
           [ 
               "data"=>Grade::select('grades.student_id', 'students.roll_no', DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname"))
            ->join('students','grades.student_id','students.id')
            ->join('subjects','grades.subject_id','subjects.id')
            // ->whereNull('grades.avg')
            // ->whereIn('grades.remarks',[null,'Passed'])
            ->where('grades.avg','<',75)
            // ->whereNull('grades.avg','<',75)
            ->groupBy('grades.student_id', 'students.roll_no', 'fullname')
            ->get()]
        );

        // return response()->json([
        //     'data' => BackSubject::select('back_subjects.student_id', 'students.roll_no', DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname"))
        //         ->join('students', 'back_subjects.student_id', 'students.id')
        //         ->groupBy('back_subjects.student_id', 'students.roll_no', 'fullname')
        //         ->get()
        // ]);
    }

    public function backrecordView($id)
    {
        return response()->json(
            Grade::select('grades.conducted_from','grades.conducted_to','grades.student_id','subjects.descriptive_title', 'grades.id', 'subjects.grade_level', 'grades.avg', 'grades.avg_now', 'grades.remarks',DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname"))
            ->join('students','grades.student_id','students.id')
            ->join('subjects','grades.subject_id','subjects.id')
            ->where('grades.avg','<',75)
            ->where('students.id', $id)
            // ->whereIn('grades.remarks',[null,'Passed'])
            // ->orWhereIn('grades.remarks',[null,'Passed'])
            ->get()

            // BackSubject::select(
            //     'students.id as student_id',
            //     'subjects.descriptive_title',
            //     'back_subjects.id',
            //     'back_subjects.grade_level',
            //     'back_subjects.prev_avg',
            //     'back_subjects.avg_now',
            //     'back_subjects.remarks',
            //     DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            // )
            //     ->join('students', 'back_subjects.student_id', 'students.id')
            //     ->join('subjects', 'back_subjects.subject_id', 'subjects.id')
            //     ->where('students.id', $id)
            //     ->get()
        );
    }

    public function updateNow(Request $request, $id)
    {
        if (!empty($request->avg_now)) {
            return Grade::whereId($id)->update([
                'avg_now' => $request->avg_now,
                'remarks' => 'Passed',
                'conducted_from' => $request->conducted_from,
                'conducted_to' => $request->conducted_to,
            ]);
        }
        // if (!empty($request->avg_now)) {
        //     return BackSubject::where('id', $id)->update([
        //         'avg_now' => $request->avg_now,
        //         'remarks' => 'Passed',
        //     ]);
        // }
    }

    public function monitorSeniorHighFailSubject($student)
    {
        return response()->json(
            BackSubject::select('subjects.descriptive_title')
                ->join('students', 'back_subjects.student_id', 'students.id')
                ->join('subjects', 'back_subjects.subject_id', 'subjects.id')
                ->where('students.id', $student)
                ->where('back_subjects.remarks', 'none')
                ->get()
        );
    }
}
