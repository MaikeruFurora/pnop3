<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function list($grade_level)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            return response()->json(Section::with('teacher')->where([['grade_level', $grade_level], ['school_year_id', Helper::activeAY()->id]])->get());
        }
    }

    public function store(Request $request)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            /**
             * 
             * FOR UPDATE
             * 
             */
            $teacher = Teacher::find($request->teacher_id);
            if (isset($request->id)) {
                $currentTeacherID =  DB::table('sections')
                    ->where([['school_year_id', Helper::activeAY()->id], ['id', $request->id]])
                    ->pluck('teacher_id')->toArray();
                $d1 = DB::table('sections')->select("teacher_id")->where('school_year_id', Helper::activeAY()->id)
                    ->whereNotIn('teacher_id', $currentTeacherID)
                    ->pluck('teacher_id')->toArray();
                if (in_array($request->teacher_id, $d1)) {
                    return response()->json([
                        'error' => 'This teacher is already assign as a adviser',
                        'currentTeacherID' => $currentTeacherID
                    ]);
                } else {
                    return Section::where('id', $request->id)->update([
                        'teacher_id' => $request->teacher_id,
                        'school_year_id' => Helper::activeAY()->id,
                        'section_name' => Str::title($request->section_name),
                        'grade_level' => $request->grade_level,
                        'class_type' => $request->class_type,
                    ]);
                }
            } else {
                /**
                 * 
                 * FOR CREATE
                 * 
                 */
                $d2 = DB::table('sections')->select("teacher_id", "section_name")->where('school_year_id', Helper::activeAY()->id)
                    ->pluck('teacher_id', 'section_name')->toArray();
                if (in_array($request->teacher_id, $d2) || in_array(Str::title($request->section_name), $d2)) {
                    return response()->json(['error' => 'This teacher is already assign as a adviser']);
                } else {
                    return $teacher->section()->create([
                        'school_year_id' => Helper::activeAY()->id,
                        'section_name' => Str::title($request->section_name),
                        'grade_level' => $request->grade_level,
                        'class_type' => $request->class_type,
                    ]);
                }
            }
        }
    }

    public function edit(Section $section)
    {

        return response()->json($section);
    }

    public function destroy($id)
    {
        return Section::findOrFail($id)->delete();
    }

    public function checkSection(Request $request)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            $data = Section::where([['school_year_id', Helper::activeAY()->id], ['section_name', $request->section_name]])->exists();
            if ($data) {
                return response()->json(['error' => 'Section name is Already added']);
            }
        }
    }
}
