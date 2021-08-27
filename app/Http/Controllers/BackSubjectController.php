<?php

namespace App\Http\Controllers;

use App\Models\BackSubject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BackSubjectController extends Controller
{
    public function backsubjectList()
    {

        return response()->json(
            BackSubject::select('subjects.descriptive_title', 'back_subjects.id', 'back_subjects.grade_level', 'back_subjects.prev_avg', 'back_subjects.avg_now', 'back_subjects.remarks')
                ->join('students', 'back_subjects.student_id', 'students.id')
                ->join('subjects', 'back_subjects.subject_id', 'subjects.id')
                ->where('students.id', Auth::user()->id)
                ->get()
        );
    }

    public function backrecordList()
    {
        return response()->json([
            'data' => BackSubject::select('back_subjects.student_id', 'students.roll_no', DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname"))
                ->join('students', 'back_subjects.student_id', 'students.id')
                ->groupBy('back_subjects.student_id', 'students.roll_no')
                ->get()
        ]);
    }

    public function backrecordView($id)
    {
        return response()->json(
            BackSubject::select(
                'students.id as student_id',
                'subjects.descriptive_title',
                'back_subjects.id',
                'back_subjects.grade_level',
                'back_subjects.prev_avg',
                'back_subjects.avg_now',
                'back_subjects.remarks',
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )
                ->join('students', 'back_subjects.student_id', 'students.id')
                ->join('subjects', 'back_subjects.subject_id', 'subjects.id')
                ->where('students.id', $id)
                ->get()
        );
    }

    public function updateNow(Request $request, $id)
    {
        if (!empty($request->avg_now)) {
            return BackSubject::where('id', $id)->update([
                'avg_now' => $request->avg_now,
                'remarks' => 'Passed',
            ]);
        }
    }
}
