<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function gradeStudentNow(Request $request)
    {
        if ($request->grade_id === "Nothing") {
            switch ($request->columnIn) {
                case '1st':
                    return Grade::create([
                        'student_id' => intval($request->student_id),
                        'teacher_id' => Auth::user()->id,
                        'subject_id' => intval($request->subject_id),
                        'first' => $request->value
                    ]);
                    break;
                case '2nd':
                    return Grade::create([
                        'student_id' => intval($request->student_id),
                        'teacher_id' => Auth::user()->id,
                        'subject_id' => intval($request->subject_id),
                        'second' => $request->value
                    ]);
                    break;
                case '3rd':
                    return Grade::create([
                        'student_id' => intval($request->student_id),
                        'teacher_id' => Auth::user()->id,
                        'subject_id' => intval($request->subject_id),
                        'third' => $request->value
                    ]);
                    break;
                case '4th':
                    return Grade::create([
                        'student_id' => intval($request->student_id),
                        'teacher_id' => Auth::user()->id,
                        'subject_id' => intval($request->subject_id),
                        'fourth' => $request->value
                    ]);
                    break;
                default:
                    return false;
                    break;
            }
        } else {
            switch ($request->columnIn) {
                case '1st':
                    return Grade::where('id', $request->grade_id)->update([
                        'first' => $request->value,
                        'avg' => $request->avg
                    ]);
                    break;
                case '2nd':
                    return Grade::where('id', $request->grade_id)->update([
                        'second' => $request->value,
                        'avg' => $request->avg
                    ]);
                    break;
                case '3rd':
                    return Grade::where('id', $request->grade_id)->update([
                        'third' => $request->value,
                        'avg' => $request->avg
                    ]);
                    break;
                case '4th':
                    // return $request->avg;
                    Grade::where('id', $request->grade_id)->update([
                        'fourth' => $request->value,
                        'avg' => $request->avg,
                    ]);
                    break;
                default:
                    return false;
                    break;
            }
        }
    }
}
