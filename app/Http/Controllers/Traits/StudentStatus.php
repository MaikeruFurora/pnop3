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
        if ($isEnrolled) {
            return 'You are Officially Enrolled';
        } else {
            return 'Enrollment status is Pending..';
        }
    }
}
