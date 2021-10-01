<?php

namespace App\Http\Controllers\Traits;

use App\Models\Enrollment;
use App\Models\SchoolYear;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

/**
 * 
 */
trait StudentStatus
{
    public function enrollStatus()
    {
        $isEnrolled = Enrollment::join('students', 'enrollments.student_id', 'students.id')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            ->where('enrollments.enroll_status', 'Enrolled')
            ->where('school_years.status', 1)
            ->where('students.id', Auth()->user()->id)
            ->exists();
        $data = Enrollment::select(
            'sections.section_name',
            'enrollments.grade_level',
            'enrollments.enroll_status',
            DB::raw("CONCAT(school_years.from,' - ',school_years.to) as ay")
        )
            ->join('students', 'enrollments.student_id', 'students.id')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            ->join('sections', 'enrollments.section_id', 'sections.id')
            ->where('school_years.status', 1)
            ->where('students.id', Auth()->user()->id)
            ->first();

        $ay = SchoolYear::select(DB::raw("CONCAT(school_years.from,' - ',school_years.to) as ay"))->where('status', 1)->first();
        if ($isEnrolled) {
            return [
                'msg' => 'Congratulations! You are Officially Enrolled',
                'section' => $data->section_name,
                'gl' => $data->grade_level,
                'ay' => $data->ay,
                'status' => 200
            ];
        } else {
            return [
                'msg' => 'Enrollment is open',
                'ay' => $ay->ay,
                // 'enroll_status' => $data->enroll_status,
                'status' => 100
            ];
        }
    }

    public function activeTerm()
    {
        if (Config::get('activeAY')->first_term == 'Yes') {
            return '1st';
        }

        if (Config::get('activeAY')->second_term == 'Yes') {
            return '2nd';
        }
    }
}
