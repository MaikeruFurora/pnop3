<?php

namespace App\Http\Controllers\Traits;

use App\Models\Enrollment;

/**
 * 
 */
trait StudentStatus
{
    public function enrollStatus()
    {
        $isEnrolled = Enrollment::join('students', 'enrollments.student_id', 'students.id')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            ->where('school_years.status', 1)
            ->where('students.id', Auth()->user()->id)
            ->exists();
        $data = Enrollment::select('sections.section_name')->join('students', 'enrollments.student_id', 'students.id')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            ->join('sections', 'enrollments.section_id', 'sections.id')
            ->where('school_years.status', 1)
            ->where('students.id', Auth()->user()->id)
            ->first();
        if ($isEnrolled) {
            return array(
                'msg' => 'Congratulations! You are Officially Enrolled',
                'section' => $data->section_name
            );
        } else {
            return 'Enrollment status is Pending..';
        }
    }
}
