<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Assign;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssignController extends Controller
{

    public function store(Request $request)
    {
        if (isset($request->id)) {
            $isSubjectisExist =  Assign::whereNotIn('id', [$request->id])->where([['section_id', $request->section_id], ['subject_id', $request->subject_id], ['school_year_id', Helper::activeAY()->id]])->exists();
            if (!$isSubjectisExist) {
                return Assign::where('id', $request->id)->update([
                    'grade_level' => $request->grade_level,
                    'school_year_id' => Helper::activeAY()->id,
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $request->teacher_id,
                ]);
            } else {
                return response()->json(['errSubject' => "Subject is already exist!"]);
            }
        } else {
            $isSubjectisExist =  Assign::where([['section_id', $request->section_id], ['subject_id', $request->subject_id], ['school_year_id', Helper::activeAY()->id]])->exists();
            if (!$isSubjectisExist) {
                return Assign::create([
                    'grade_level' => $request->grade_level,
                    'school_year_id' => Helper::activeAY()->id,
                    'section_id' => $request->section_id,
                    'subject_id' => $request->subject_id,
                    'teacher_id' => $request->teacher_id,
                ]);
            } else {
                return response()->json(['errSubject' => "Subject is already exist!"]);
            }
        }
    }

    public function search($grade_level)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['warning' => 'No Academic Year Active']);
        } else {
            return response()->json(
                Section::where([['grade_level', $grade_level], ['school_year_id', Helper::activeAY()->id]])->get()
            );
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
    public function searchBySubject(Section $section, $action)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['warning' => 'No Academic Year Active']);
        } else {
            // return $section;
            if ($action == "adding") {
                $data = Assign::select('subject_id')->where('section_id', $section->id)->pluck('subject_id')->toArray();
                return response()->json(Subject::where('grade_level', $section->grade_level)
                    ->whereIn('subject_for', [$section->class_type, 'GENERAL'])
                    ->whereNotIn('id', $data)
                    ->get());
            } else {
                return response()->json(Subject::where('grade_level', $section->grade_level)
                    ->whereIn('subject_for', [$section->class_type, 'GENERAL'])
                    ->get());
            }
        }
    }

    public function list($section)
    {
        return response()->json(
            DB::table("assigns")
                ->select("assigns.*", "subjects.subject_code", "subjects.descriptive_title", "sections.section_name", "teachers.teacher_firstname", "teachers.teacher_lastname", "teachers.teacher_middlename")
                ->join("sections", "assigns.section_id", "sections.id")
                ->join("subjects", "assigns.subject_id", "subjects.id")
                ->join("teachers", "assigns.teacher_id", "teachers.id")
                ->where("assigns.school_year_id", Helper::activeAY()->id)
                ->where("sections.id", $section)
                ->get()
        );
    }

    public function edit(Assign $assign)
    {
        return response()->json($assign);
    }

    public function destroy(Assign $assign)
    {
        return $assign->delete();
    }
}
