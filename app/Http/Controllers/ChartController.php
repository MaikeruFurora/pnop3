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
        if (isset(Config::get('activeAY')->id)) {
            $grade_level = Enrollment::select('grade_level')->where('enroll_status', 'Enrolled')->orderBy('grade_level', 'asc')->groupBy('grade_level')->pluck('grade_level');
            $population = Enrollment::select(DB::raw("COUNT(if (enroll_status='Enrolled',1,NULL)) as enrolled"))
                ->where('enroll_status', 'Enrolled')
                ->where('school_year_id', Config::get('activeAY')->id)
                ->orderBy('grade_level', 'asc')
                ->groupBy('grade_level')
                ->pluck('enrolled');
            $arryPopulation = array(
                'grade_level' => $grade_level,
                'population' => $population
            );
            return response()->json($arryPopulation);
        } else {
            return false;
        }
    }


    public function populationBySex()
    {
        $sex = Student::select(DB::raw("COUNT(if (gender='Male',1,NULL)) as Male"), DB::raw("COUNT(if (gender='Female',1,NULL)) as Female"))
            ->orderBy('gender', 'asc')
            ->groupBy('gender')
            ->get();
        return response()->json($sex);
    }

    public function populationByCurriculum()
    {
        if (Enrollment::count() > 0) {
            $array = array();
            $stem = Enrollment::select(DB::raw("COUNT(if (curriculum='STEM',1,NULL)) as stem"))
                ->where('enroll_status', 'Enrolled')
                ->where('school_year_id', Config::get('activeAY')->id)
                ->pluck('stem');
            $bec = Enrollment::select(DB::raw("COUNT(if (curriculum='BEC',1,NULL)) as bec"))
                ->where('enroll_status', 'Enrolled')
                ->where('school_year_id', Config::get('activeAY')->id)
                ->pluck('bec');
            $spa = Enrollment::select(DB::raw("COUNT(if (curriculum='SPA',1,NULL)) as spa"))
                ->where('enroll_status', 'Enrolled')
                ->where('school_year_id', Config::get('activeAY')->id)
                ->pluck('spa');
            $spj = Enrollment::select(DB::raw("COUNT(if (curriculum='SPJ',1,NULL)) as spj"))
                ->where('enroll_status', 'Enrolled')
                ->where('school_year_id', Config::get('activeAY')->id)
                ->pluck('spj');
            array_push($array, ['stem' => $stem[0], 'bec' => $bec[0], 'spa' => $spa[0], 'spj' => $spj[0]]);
            return response()->json($array);
        } else {
            return false;
        }
    }
}
