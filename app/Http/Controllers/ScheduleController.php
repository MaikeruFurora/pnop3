<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function searchType($type)
    {
        switch ($type) {
            case 'section':
                // return response()->json(Section::where('school_year_id', Helper::activeAY()->id)->get());
                return response()->json(
                    DB::table('sections')
                        ->select("sections.section_name", "sections.id")
                        ->join("schedules", "sections.id", "schedules.section_id")
                        ->where('schedules.school_year_id', Helper::activeAY()->id)
                        ->groupBy('sections.section_name', "sections.id")->get()
                );
                break;
            case 'teacher':
                return response()->json(
                    DB::table('teachers')
                        ->select("teachers.teacher_firstname", "teachers.teacher_middlename", "teachers.teacher_lastname", "teachers.id")
                        ->join("schedules", "teachers.id", "schedules.teacher_id")
                        ->where('schedules.school_year_id', Helper::activeAY()->id)
                        ->distinct("teachers.teacher_firstname", "teachers.teacher_middlename", "teachers.teacher_lastname", "teachers.id")->get()
                );
                break;
            default:
                return false;
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
        return Schedule::create([
            'grade_level' => $request->grade_level,
            'school_year_id' => Helper::activeAY()->id,
            'section_id' => $request->section_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            'monday' => $request->has('monday'),
            'tuesday' => $request->has('tuesday'),
            'wednesday' => $request->has('wednesday'),
            'thursday' => $request->has('thursday'),
            'friday' => $request->has('friday'),
            'sched_from' => $request->sched_from,
            'sched_to' => $request->sched_to,
        ]);
    }

    public function list($type, $value)
    {
        switch ($type) {
            case 'section':
                return response()->json(
                    DB::table("schedules")
                        ->select("schedules.*", "subjects.subject_code", "subjects.descriptive_title", "sections.section_name", "teachers.teacher_firstname", "teachers.teacher_lastname", "teachers.teacher_middlename")
                        ->join("sections", "schedules.section_id", "sections.id")
                        ->join("subjects", "schedules.subject_id", "subjects.id")
                        ->join("teachers", "schedules.teacher_id", "teachers.id")
                        ->where("schedules.school_year_id", Helper::activeAY()->id)
                        ->where("sections.id", $value)
                        ->get()
                );
                break;
            case 'teacher':
                return response()->json(
                    DB::table("schedules")
                        ->select("schedules.*", "subjects.subject_code", "subjects.descriptive_title", "sections.section_name", "teachers.teacher_firstname", "teachers.teacher_lastname", "teachers.teacher_middlename")
                        ->join("teachers", "schedules.teacher_id", "teachers.id")
                        ->join("sections", "schedules.section_id", "sections.id")
                        ->join("subjects", "schedules.subject_id", "subjects.id")
                        ->where("schedules.school_year_id", Helper::activeAY()->id)
                        ->where("teachers.id", $value)
                        ->get()
                );
                break;
            default:
                return false;
                break;
        }
    }
}
