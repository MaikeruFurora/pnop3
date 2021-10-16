<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChairmanSHSController extends Controller
{

    // senior high---------------
    public function seniorEnrollee()
    {
        return view('teacher/chairman/enroll-shs', [
            'strands' => Strand::all()
        ]);
    }
    public function enrolleeSort($strand, $term)
    {
        return response()->json([
            'data' => Enrollment::select(
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
                ->where('enrollments.strand_id', $strand)
                ->where('enrollments.term', $term)
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->get()
        ]);
    }

    public function manageSection()
    {
        $strands = Strand::all();
        $teachers = Teacher::all();
        return view('teacher/chairman/section-shs', compact('teachers', 'strands'));
    }

    public function saveSection(Request $request)
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
                        'section_name' => strtoupper($request->section_name),
                        'grade_level' => $grade_level,
                        'strand_id' => $request->strand_id,
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
                        'section_name' => strtoupper($request->section_name),
                        'grade_level' => $grade_level,
                        'strand_id' => $request->strand_id,
                    ]);
                }
            }
        }
    }

    public function sectionList()
    {
        if (empty(Helper::activeAY())) {
            return response()->json(['error' => 'No Academic Year Active']);
        } else {
            return response()->json(
                Section::with('strand')->with('teacher')->where([['grade_level', auth()->user()->chairman_info->grade_level], ['school_year_id', Helper::activeAY()->id]])->get()
            );
            //join('strands', 'sections.strand_id', 'strands.id')->
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

    public function monitorSection($strand, $term)
    {
        return response()->json(
            Enrollment::select('sections.section_name', DB::raw('count(*) as total'))
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->where('sections.strand_id', $strand)
                ->where('enrollments.term', $term)
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->groupBy('section_name')
                ->get()
        );
    }

    public function printReport($section, $term)
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
            ->where('enrollments.term', $term)
            ->where('enrollments.school_year_id', Helper::activeAY()->id)
            ->groupBy('sections.section_name')->first();
        return view('teacher/chairman/partial/print', compact('dataNow', 'section', 'total'));
    }

    public function dashMonitor()
    {
        return response()->json(
            Enrollment::select('strands.strand', DB::raw("COUNT(if (enroll_status='Enrolled',1,NULL)) as enrolled"), DB::raw("COUNT(if (enroll_status='Pending',1,NULL)) as pending"))
                ->join('strands', 'enrollments.strand_id', 'strands.id')
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->where('enrollments.term', '1st')
                ->groupBy('strands.strand')
                ->get()
        );
    }
}
