<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Chairman;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChairmanController extends Controller
{
    public function store(Request $request)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            if (isset($request->id)) {
                $currentTeacherID =  DB::table('chairmen')
                    ->where([['school_year_id', Helper::activeAY()->id], ['id', $request->id]])
                    ->pluck('teacher_id')->toArray();
                $d1 = DB::table('chairmen')->select("teacher_id")->where('school_year_id', Helper::activeAY()->id)
                    ->whereNotIn('teacher_id', $currentTeacherID)
                    ->pluck('teacher_id')->toArray();
                if (in_array($request->teacher_id, $d1)) {
                    return response()->json([
                        'error' => 'This teacher is already assign as a chairman',
                        'currentTeacherID' => $currentTeacherID
                    ]);
                } else {
                    return Chairman::where('id', $request->id)->update([
                        'grade_level' => $request->grade_level,
                        'teacher_id' => $request->teacher_id,
                        'school_year_id' => Helper::activeAY()->id
                    ]);
                }
            } else {

                $d1 = DB::table('chairmen')->select("teacher_id")->where('school_year_id', Helper::activeAY()->id)
                    ->pluck('teacher_id')->toArray();
                $d2 = DB::table('chairmen')->select("grade_level")->where('school_year_id', Helper::activeAY()->id)
                    ->pluck('grade_level')->toArray();
                if (in_array($request->grade_level, $d2) || in_array($request->teacher_id, $d1)) {
                    return response()->json(['error' => 'Teacher or Grade level are already assign']);
                } else {
                    return Chairman::create([
                        'grade_level' => $request->grade_level,
                        'teacher_id' => $request->teacher_id,
                        'school_year_id' => Helper::activeAY()->id
                    ]);
                }
            }
        }
    }

    public function list()
    {
        return response()->json(
            DB::table("chairmen")
                ->select("chairmen.*", "teachers.teacher_firstname", "teachers.teacher_lastname", "teachers.teacher_middlename")
                ->join("teachers", "chairmen.teacher_id", "teachers.id")
                ->where("chairmen.school_year_id", Helper::activeAY()->id)
                ->get()

        );
    }

    public function destroy(Chairman $chairman)
    {
        return $chairman->delete();
    }

    public function edit(Chairman $chairman)
    {

        return response()->json($chairman);
    }

    // teacher and chairman setting control

    public function section()
    {
        if (Auth::user()->chairman->where('school_year_id', session('sessionAY')->id)->exists()) {
            $teachers = Teacher::all();
            return view('teacher/chairman/section', compact('teachers'));
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }


    public function sectionList()
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            return response()->json(Section::with('teacher')->where([['grade_level', auth()->user()->chairman->grade_level], ['school_year_id', Helper::activeAY()->id]])->get());
        }
    }

    public function sectionSave(Request $request)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            $grade_level =  auth()->user()->chairman->grade_level;
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
                        'grade_level' => $grade_level,
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
                        'grade_level' => $grade_level,
                        'class_type' => $request->class_type,
                    ]);
                }
            }
        }
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

    public function sectionEdit(Section $section)
    {

        return response()->json($section);
    }

    public function sectionDestroy(Section $section)
    {
        return $section->delete();
    }

    public function searchSecionByLevel($curriculum)
    {
        return response()->json(Section::where("grade_level", auth()->user()->chairman->grade_level)
            ->where("class_type", $curriculum)
            ->get());
    }


    // page ng lahat ng mga curriculum
    public function stempage()
    {
        if (Auth::user()->chairman->where('school_year_id', session('sessionAY')->id)->exists()) {
            return view('teacher/chairman/stem');
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }

    public function becpage()
    {
        if (Auth::user()->chairman->where('school_year_id', session('sessionAY')->id)->exists()) {
            return view('teacher/chairman/bec');
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }

    // table list per curriculum

    public function tableList($class)
    {
        return response()->json(
            [
                'data' =>
                Enrollment::select(
                    "enrollments.*",
                    "student_firstname",
                    "student_middlename",
                    "student_lastname",
                    "roll_no",
                    "student_contact",
                    "section_name"
                )
                    ->join('students', 'enrollments.student_id', 'students.id')
                    ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                    ->where('sections.class_type', $class)
                    ->get()
            ]
        );
    }

    public function monitorSection($curriculum)
    {
        // return response()->json([

        // ]);

        return Enrollment::select('sections.section_name', DB::raw('count(*) as total'))
            ->join('sections', 'enrollments.section_id', 'sections.id')
            ->where('sections.class_type', $curriculum)
            ->groupBy('section_name')
            ->get();
    }
}