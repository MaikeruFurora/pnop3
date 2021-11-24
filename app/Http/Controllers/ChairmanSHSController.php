<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Enrollment;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\Newassign;
use App\Models\Grade;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RequestStack;

class ChairmanSHSController extends Controller
{

    // senior high---------------
    public function seniorEnrollee()
    {
        return view('teacher/chairman/enroll-shs', [
            'strands' => Strand::all(),
            'school_years' => SchoolYear::all()
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
            Enrollment::select('enrollments.section_id','sections.section_name', DB::raw('count(*) as total'))
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->where('sections.strand_id', $strand)
                ->where('enrollments.term', $term)
                ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->groupBy('section_name','enrollments.section_id')
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
            ->where('sections.id', $section)
            ->where('enrollments.grade_level', auth()->user()->chairman_info->grade_level)
            ->where('enrollments.school_year_id', Helper::activeAY()->id)
            ->orderBy('students.gender', 'desc')
            ->where('enrollments.term', $term)
            ->get();
        $total = Enrollment::select('sections.section_name', DB::raw('count(if(gender="Female",1,NULL)) as ftotal'), DB::raw('count(if(gender="Male",1,NULL)) as mtotal'))
            ->join('students', 'enrollments.student_id', 'students.id')
            ->join('sections', 'enrollments.section_id', 'sections.id')
            ->where('sections.id', $section)
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

    public function enrolleeStudentInfo($id){
        return response()->json(
            Enrollment::select(
                'enrollments.id as enrolId',
                'enrollments.grade_level',
                'strands.id as strId',
                'enrollments.student_id',
                'enrollments.section_id',
                'enrollments.term',
                'sections.section_name',
                'roll_no',
                'strand',
                'description',
                'enroll_status',
                'term',
                'state',
                DB::raw("CONCAT(student_lastname,', ',student_firstname,' ', student_middlename) AS fullname"))
            ->join('students','enrollments.student_id','students.id')
            ->join('strands', 'enrollments.strand_id', 'strands.id')
            ->join('sections', 'enrollments.section_id', 'sections.id')
            ->where('enrollments.id',$id)
            ->first()
        );
    }

    // get all subject under core and specialized
    public function enrolledSubject($strand,$grade_level,$student,$term){
        return response()->json(
            [
                'origSubject'=>Subject::select('subjects.id','descriptive_title','subject_code')
                    ->leftjoin('strands','subjects.strand_id','strands.id')
                    // ->where('indicate_type','Core')
                    ->where('grade_level',$grade_level)
                    ->where('subjects.term',$term)
                    ->whereNotIn('subjects.id',
                            Subject::select('subjects.id')
                            ->leftjoin('strands','subjects.strand_id','strands.id')
                            ->where('indicate_type','Core')
                            ->where('grade_level',$grade_level)
                            // ->where('subjects.term',$term)
                            ->whereIn('subjects.prerequisite',
                                Grade::select('grades.subject_id')
                                ->join('students','grades.student_id','students.id')
                                ->join('subjects','grades.subject_id','subjects.id')
                                ->where('grades.student_id',$student)
                                ->orwhereIn('grades.remarks',['Repeated',null])
                                ->where('grades.avg','<',75)
                                ->where('grades.avg','!=',0)
                                ->pluck('grades.subject_id'))
                            ->pluck('subjects.id')
                    )
                    ->orWhere('strands.id',$strand)
                    ->get(),
                'mySubject'=> Newassign::select('subject_id')
                ->join('sections','newassigns.section_id','sections.id')
                ->where('sections.school_year_id',Helper::activeAY()->id)
                    ->where('term',$term)
                    // ->where('term',Helper::activeTerm())
                    ->where('sections.grade_level',auth()->user()->chairman_info->grade_level)
                    ->where('student_id',$student)
                    ->pluck('subject_id'),

                'NewId'=> Newassign::select('newassigns.id')
                ->join('sections','newassigns.section_id','sections.id')
                ->where('sections.school_year_id',Helper::activeAY()->id)
                    ->where('term',$term)
                    // ->where('term',Helper::activeTerm())
                    ->where('sections.grade_level',auth()->user()->chairman_info->grade_level)
                    ->where('student_id',$student)
                    ->pluck('newassigns.id'),

                'backsubject'=>Subject::select('subjects.id','descriptive_title','subject_code')
                ->leftjoin('strands','subjects.strand_id','strands.id')
                ->whereIn('subjects.id',
                    Subject::select('prerequisite')
                    ->whereIn('subjects.prerequisite',
                        Grade::select('grades.subject_id')
                        ->join('students','grades.student_id','students.id')
                        ->join('subjects','grades.subject_id','subjects.id')
                        ->where('grades.student_id',$student)
                        // ->whereIn('grades.remarks',['Repeated'])
                        ->where('grades.avg','<',75)
                        ->where('grades.avg','!=',0)
                        ->pluck('grades.subject_id')
                        ->whereNull('grades.remarks')
                    )->pluck('prerequisite')
                )->get()
                
            ]
        );
    }




    protected function partialCode($request,$grade_id=null){

            Grade::create([
                'section_id'=>$request->section_id,
                'subject_id'=>$request->subject_id,
                'student_id'=>$request->student_id,
                'term'=>Helper::activeTerm(),
            ]);
            Newassign::create([
            'student_id'=>$request->student_id,
            'subject_id'=>$request->subject_id,
            'section_id'=>$request->section_id,
            'term'=>Helper::activeTerm(),
            ]);

            if (!empty($grade_id)) {
                Grade::whereId($grade_id)
                ->update([
                    'remarks'=>'Repeated'
                ]);


                // subject info if have prerquisite
                $gradeData=Grade::whereId($grade_id)->first();
                $getData=Subject::where('prerequisite',$gradeData->subject_id)->first();
                if ($getData) {
                    Grade::create([
                        'section_id'=>$request->section_id,
                        'subject_id'=>$getData->id,
                        'student_id'=>$request->student_id,
                        // 'term'=>Helper::activeTerm(),
                        'avg'=>0
                    ]);
                }
                
            }

    }
    public function enrolledSubjectSave(Request $request){
        //->where('term',Helper::activeTerm())
       $have = Grade::where('subject_id',$request->subject_id)->where('student_id',$request->student_id)->exists();
       //check if exist na tong subject sa student
        if($have){
            //if exist check natin kung ang student ay fail or pass
          $haveLowerGrade=Grade::where('subject_id',$request->subject_id)->where('student_id',$request->student_id)->where('avg','<',75)->whereNull('remarks')->first();
            
            if ($haveLowerGrade) {
                // $isPassed=  Grade::join('subjects','grades.subject_id','subjects.id')
                // ->whereIn('subjects.id',[$request->subject_id])
                // ->whereNotNull('avg_now')
                // ->where('student_id',$request->student_id)
                // ->exists();
                // if ($isPassed) {
                //     return response()->json(['msg'=>'Meron na siya ng subject na yan']);
                // } else {
                    $this->partialCode($request,$haveLowerGrade->id);
                // }
                
            }else{
                return response()->json(['msg'=>'Meron na siya ng subject na yan']);
            }
        }else{
            $this->partialCode($request);    
        }
       
    }

    //for future use nalang to
    public function suggestedSubject($strand,$grade_level){
        
    }

    //my subject list
    public function mysubjectNow($student,$section){
        return response()->json(
            Newassign::select('newassigns.id','descriptive_title','subject_code')
            ->join('subjects','newassigns.subject_id','subjects.id')
            ->where('student_id',$student)
            ->where('section_id',$section)
            ->get()
        );
    }

    public function removeEnrolledSubject(Request $request){
        // return $request->all();
         $confirm = Grade::where('student_id',$request->student_id)
        ->where('subject_id',$request->subject_id)
        ->where('term',$request->term)
        ->whereNull('avg')
        ->exists();
        if ($confirm) {
            Grade::where('student_id',$request->student_id)
            ->where('section_id',$request->section_id)
            ->where('subject_id',$request->subject_id)
            ->where('term',$request->term)
            ->whereNull('avg')
            ->delete();

            Newassign::where('subject_id',$request->subject_id)
            ->where('section_id',$request->section_id)
            ->where('student_id',$request->student_id)
            ->where('term',$request->term)
            ->delete();
        }else{
            return 'not';
        }
        
    }


    public function retriveGrade($grade_level,$term,$student){
    
        return response()->json(
            Grade::select(
                'grades.avg',
                'sections.section_name',
                'subjects.subject_code',
                'subjects.descriptive_title',
                'subjects.grade_level',
                DB::raw("CONCAT(teachers.teacher_lastname,', ',teachers.teacher_firstname,' ',teachers.teacher_middlename) as fullname")
            )
                ->join("students", "grades.student_id", "students.id")
                ->join('subjects', 'grades.subject_id', 'subjects.id')
                ->join('sections', 'grades.section_id', 'sections.id')
                ->join('teachers', 'sections.teacher_id', 'teachers.id')
                ->where('students.id', $student)
                ->where('subjects.grade_level', $grade_level)
                ->where('grades.term', $term)
                ->get()
            );
        
    }
}
