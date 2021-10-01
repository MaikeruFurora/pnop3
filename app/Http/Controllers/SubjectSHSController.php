<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectSHSController extends Controller
{
    public function store(Request $request)
    {
        return Subject::updateorcreate(['id' => $request->shs_id], [
            'strand_id' => $request->shs_strand_id ?? null,
            'grade_level' => $request->shs_grade_level ?? null,
            'subject_code' => $request->shs_subject_code,
            'descriptive_title' => $request->shs_descriptive_title,
            'indicate_type' => $request->shs_indicate_type,
        ]);
    }

    public function list()
    {
        return response()->json([
            'data' => Subject::select('subjects.id', 'strands.strand', 'indicate_type', 'grade_level', 'subject_code', 'descriptive_title')
                ->leftjoin('strands', 'subjects.strand_id', 'strands.id')
                ->whereNull('subject_for')
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
