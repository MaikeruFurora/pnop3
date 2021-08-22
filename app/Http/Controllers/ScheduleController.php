<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Assign;
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

    public function searchBySection($grade_level)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['warning' => 'No Academic Year Active']);
        } else {
            return response()->json(Section::where([['grade_level', $grade_level], ['school_year_id', Helper::activeAY()->id]])->get());
        }
    }

    public function searchBySubject(Section $section)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['warning' => 'No Academic Year Active']);
        } else {
            // return $section;
            $data = Assign::select('subject_id')->where('section_id', $section->id)->pluck('subject_id')->toArray();
            return response()->json(Subject::where('grade_level', $section->grade_level)
                ->whereIn('subject_for', [$section->class_type, 'GENERAL'])
                ->whereNotIn('id', $data)
                ->get());
        }
    }


    public function store(Request $request)
    {
        $postSF = strval(explode(" ", $request->sched_from)[0]);
        $postST = strval(explode(" ", $request->sched_to)[0]);
        $checkTime = Schedule::select("sched_from", "sched_to")->whereNotIn('id', [$request->id])->where([['section_id', $request->section_id], ['school_year_id', Helper::activeAY()->id]])->get();
        if (isset($request->id)) {
            $isSubjectisExist =  Schedule::whereNotIn('id', [$request->id])->where([['section_id', $request->section_id], ['subject_id', $request->subject_id], ['school_year_id', Helper::activeAY()->id]])->exists();
            if (!$this->check_time_overlap($postSF, $postST, $checkTime)) {
                return Schedule::where('id', $request->id)->update([
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
            } else {
                return response()->json(['errTime' => "Conflict Time or Overlapping!!"]);
            }
        } else {
            $isSubjectisExist =  Schedule::where([['section_id', $request->section_id], ['subject_id', $request->subject_id], ['school_year_id', Helper::activeAY()->id]])->exists();
            if (!$isSubjectisExist) {
                $checkTime = Schedule::select("sched_from", "sched_to", "monday")->where([['section_id', $request->section_id], ['school_year_id', Helper::activeAY()->id]])->get();
                if (!$this->check_time_overlap($postSF, $postST, $checkTime)) {
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
                } else {
                    return response()->json(['errTime' => "Conflict Time or Overlapping!!"]);
                }
            } else {
                return response()->json(['errSubject' => "Subject is already exist!"]);
            }
        }
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

    public function edit(Schedule $schedule)
    {
        return response()->json($schedule);
    }

    public function destroy(Schedule $schedule)
    {
        return $schedule->delete();
    }

    public function check_time_overlap($psf, $pst, $arr)
    {
        //from POST
        $post_sched_from = strtotime($psf);
        $post_sched_to   = strtotime($pst);


        foreach ($arr as $key => $value) {
            //from DATABASE
            $db_sched_from = strtotime(explode(" ", $value->sched_from)[0]);
            $db_sched_to   = strtotime(explode(" ", $value->sched_to)[0]);
            if ($db_sched_from > $post_sched_from && $db_sched_to < $post_sched_to) {
                // Check time is in between start and end time
                //  "1 Time is in between start and end time";
                return true;
            } elseif (($db_sched_from > $post_sched_from && $db_sched_from < $post_sched_to) || ($db_sched_to > $post_sched_from && $db_sched_to < $post_sched_to)) {
                // Check start or end time is in between start and end time
                //  "2 ChK start or end Time is in between start and end time";
                return true;
            } elseif ($db_sched_from == $post_sched_from || $db_sched_to == $post_sched_to) {
                // Check start or end time is at the border of start and end time
                //  "3 ChK start or end Time is at the border of start and end time";
                return true;
            } elseif ($post_sched_from > $db_sched_from && $post_sched_to < $db_sched_to) {
                // start and end time is in between  the check start and end time.
                //  "4 start and end Time is overlapping  chk start and end time";
                return true;
            }
        }

        return false;
    }
}
