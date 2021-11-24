<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectSHSController extends Controller
{
    public function store(Request $request)
    {
        return Subject::updateorcreate(['id' => $request->shs_id], [
            'strand_id' => $request->shs_strand_id=='all'?null:$request->shs_strand_id,
            'grade_level' => $request->shs_grade_level ?? null,
            'subject_code' => $request->shs_subject_code,
            'descriptive_title' => $request->shs_descriptive_title,
            'indicate_type' => $request->shs_indicate_type,
            'prerequisite' => $request->shs_prerequisite ?? null,
            'term' => $request->shs_term,
        ]);
    }

    public function list($strand,$grade,$term)
    {
        return response()->json([
            'data' => Subject::select('subjects.id', 'strands.strand', 'subjects.indicate_type', 'subjects.subject_code', 'subjects.descriptive_title','Subpre.descriptive_title as prerequisite','Subpre.subject_code as presubject_code')
                ->leftjoin('strands', 'subjects.strand_id', 'strands.id')
                ->leftjoin('subjects as Subpre', 'subjects.prerequisite', 'Subpre.id')
                ->whereNull('strands.id')
                ->where('subjects.grade_level',$grade)
                ->where('subjects.term',$term)
                ->whereNull('subjects.subject_for')
                ->orWhere('subjects.strand_id',$strand)
                ->get()
        ]);
    }

    public function destroy(Subject $subject)
    {
        return $subject->delete();
    }

    public function edit(Subject $subject)
    {
        return response()->json($subject);
    }
}
