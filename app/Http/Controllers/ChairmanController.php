<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Chairman;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Strand;
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
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            return response()->json(
                DB::table("chairmen")
                    ->select("chairmen.*", "teachers.teacher_firstname", "teachers.teacher_lastname", "teachers.teacher_middlename")
                    ->join("teachers", "chairmen.teacher_id", "teachers.id")
                    ->where("chairmen.school_year_id", Helper::activeAY()->id)
                    ->get()

            );
        }
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
        if (Auth::user()->chairman) {
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
            return response()->json(Section::with('teacher')->where([['grade_level', auth()->user()->chairman_info->grade_level], ['school_year_id', Helper::activeAY()->id]])->get());
        }
    }

    public function sectionSave(Request $request)
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            $grade_level =  auth()->user()->chairman_info->grade_level;
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
        return response()->json(
            Section::select('sections.id', 'sections.section_name')
                ->join('school_years', 'sections.school_year_id', 'school_years.id')
                ->where("grade_level", auth()->user()->chairman_info->grade_level)
                ->where("school_years.status", 1)
                ->where("class_type", $curriculum)
                ->get()
        );
    }


    // page ng lahat ng mga curriculum
    public function stempage()
    {
        if (Auth::user()->chairman) {
            return view('teacher/chairman/stem');
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }

    public function becpage()
    {
        if (Auth::user()->chairman) {
            return view('teacher/chairman/bec');
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }

    public function spapage()
    {
        if (Auth::user()->chairman) {
            return view('teacher/chairman/spa');
        } else {
            return redirect()->route('teacher.dashboard');
        }
    }

    public function spjpage()
    {
        if (Auth::user()->chairman) {
            return view('teacher/chairman/spj');
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
                    "req_psa",
                    "req_grade",
                    "req_goodmoral",
                    "isbalik_aral",
                    "last_schoolyear_attended",
                    "roll_no",
                    "student_contact",
                    "section_name",
                    DB::raw("CONCAT(student_lastname,', ',student_firstname,' ', student_middlename) AS fullname")
                )
                    ->join('students', 'enrollments.student_id', 'students.id')
                    ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                    ->where('enrollments.curriculum', $class)
                    ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                    ->where('enrollments.school_year_id', Helper::activeAY()->id)
                    ->get()
            ]
        );
    }
    public function tableListFiltred($curriculum, $barangay)
    {
        if ($barangay === 'All') {
            $data = Enrollment::select(
                "enrollments.*",
                "student_firstname",
                "student_middlename",
                "student_lastname",
                "req_psa",
                "req_grade",
                "req_goodmoral",
                "isbalik_aral",
                "last_schoolyear_attended",
                "roll_no",
                "student_contact",
                "section_name",
                DB::raw("CONCAT(student_lastname,', ',student_firstname,' ', student_middlename) AS fullname")
            )
                ->join('students', 'enrollments.student_id', 'students.id')
                ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                ->where('enrollments.curriculum', $curriculum)
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->get();
        } else {
            $data = Enrollment::select(
                "enrollments.*",
                "student_firstname",
                "student_middlename",
                "student_lastname",
                "req_psa",
                "req_grade",
                "req_goodmoral",
                "isbalik_aral",
                "last_schoolyear_attended",
                "roll_no",
                "student_contact",
                "section_name",
                DB::raw("CONCAT(student_lastname,', ',student_firstname,' ', student_middlename) AS fullname")
            )
                ->join('students', 'enrollments.student_id', 'students.id')
                ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                ->where('enrollments.curriculum', $curriculum)
                ->where('students.barangay', $barangay)
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->get();
        }

        return response()->json(['data' => $data]);
    }

    public function tableListEnrolledStudent($section)
    {
        return response()->json(
            Enrollment::select(
                "enrollments.id",
                "students.gender",
                "section_name",
                DB::raw("CONCAT(student_lastname,', ',student_firstname,' ', student_middlename) AS fullname")
            )
                ->join('students', 'enrollments.student_id', 'students.id')
                ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
                ->where('sections.section_name', $section)
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->orderBy('students.gender', 'desc')
                ->get()
        );
    }

    public function monitorSection($curriculum)
    {
        return response()->json(
            Enrollment::select('sections.section_name', DB::raw('count(*) as total'))
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->where('sections.class_type', $curriculum)
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->groupBy('section_name')
                ->get()
        );
    }

    public function filterbarangay($curriculum)
    {
        return response()->json(
            Enrollment::select('students.city', 'students.barangay')
                ->join('students', 'enrollments.student_id', 'students.id')
                ->where('enrollments.curriculum', $curriculum)
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->groupBy('barangay', 'city')
                ->orderBy('city')
                ->get()
        );
    }

    public function dashMonitor()
    {
        return response()->json(
            Enrollment::select('enrollments.curriculum', DB::raw("COUNT(if (enroll_status='Enrolled',1,NULL)) as enrolled"), DB::raw("COUNT(if (enroll_status='Pending',1,NULL)) as pending"))
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->groupBy('enrollments.curriculum')
                ->get()
        );
    }

    public function printReport($section)
    {

        $dataNow = Enrollment::select(
            "enrollments.id",
            "students.gender",
            DB::raw("CONCAT(student_lastname,', ',student_firstname,' ', student_middlename) AS fullname")
        )
            ->join('students', 'enrollments.student_id', 'students.id')
            ->leftjoin('sections', 'enrollments.section_id', 'sections.id')
            ->where('sections.section_name', $section)
            ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
            ->where('enrollments.school_year_id', Helper::activeAY()->id)
            ->orderBy('students.gender', 'desc')
            ->get();
        $total = Enrollment::select('sections.section_name', DB::raw('count(if(gender="Female",1,NULL)) as ftotal'), DB::raw('count(if(gender="Male",1,NULL)) as mtotal'))
            ->join('students', 'enrollments.student_id', 'students.id')
            ->join('sections', 'enrollments.section_id', 'sections.id')
            ->where('sections.section_name', $section)
            ->where('enrollments.school_year_id', Helper::activeAY()->id)
            ->groupBy('sections.section_name')->first();
        return view('teacher/chairman/partial/print', compact('dataNow', 'section', 'total'));
    }
}
