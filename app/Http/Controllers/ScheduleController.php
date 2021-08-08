<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function searchType($type)
    {
        switch ($type) {
            case 'section':
                return response()->json(Section::where('school_year_id', Helper::activeAY()->id)->get());
                break;
            case 'teacher':
                return response()->json(Teacher::all());
                break;
            default:
                return response()->json(Section::where('school_year_id', Helper::activeAY()->id)->get());
                break;
        }
    }

    public function searchByGradeLevel($grade_level)
    {
        return response()->json([
            'section' => Section::where([['grade_level', $grade_level], ['school_year_id', Helper::activeAY()->id]])->get(),
            'subject' => Subject::where([['grade_level', $grade_level]])->get()
        ]);
    }


    public function store(Request $request)
    {
        return $request->all();
    }
}
