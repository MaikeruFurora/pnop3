<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function populationByGradeLevel()
    {
        $grade_level = Enrollment::select('grade_level')->where('enroll_status', 'Enrolled')->groupBy('grade_level')->orderBy('grade_level', 'asc')->pluck('grade_level');
        $population = Enrollment::select(DB::raw("COUNT(if (enroll_status='Enrolled',1,NULL)) as enrolled"))
            ->where('enroll_status', 'Enrolled')
            ->where('school_year_id', Config::get('activeAY')->id)
            ->groupBy('grade_level')
            ->orderBy('grade_level', 'asc')
            ->pluck('enrolled');
        $arryPopulation = array(
            'grade_level' => $grade_level,
            'population' => $population
        );
        return response()->json($arryPopulation);
    }


    public function populationBySex()
    {
        $sex = Student::select(DB::raw("COUNT(if (gender='Male',1,NULL)) as Male"), DB::raw("COUNT(if (gender='Female',1,NULL)) as Female"))
            ->orderBy('gender', 'asc')
            ->get();
        return response()->json($sex);
    }

    public function populationByCurriculum()
    {
        $curriculum = Student::select(
            DB::raw("COUNT(if (curriculum='STEM',1,NULL)) as stem"),
            DB::raw("COUNT(if (curriculum='BEC',1,NULL)) as bec"),
            DB::raw("COUNT(if (curriculum='SPA',1,NULL)) as spa"),
            DB::raw("COUNT(if (curriculum='SPJ',1,NULL)) as spj")
        )
            ->orderBy('curriculum', 'asc')
            ->get();
        return response()->json($curriculum);
    }
}
