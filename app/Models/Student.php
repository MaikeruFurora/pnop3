<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $guarded = [];
    protected $date = ['deleted_at'];
    protected $casts = [
        'roll_no' => 'integer',
        'username' => 'string',
    ];


    public function getFullnameAttribute()
    {
        return ucwords("{$this->student_firstname} {$this->student_lastname}");
    }
    public function grade()
    {
        return $this->hasMany(Grade::class);
    }

    public function enrollment()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function backsubject()
    {
        return $this->hasMany(BackSubject::class);
    }

    public function getGradeLevelAttribute()
    {
        return Enrollment::select('enrollments.grade_level')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            ->where('school_years.status', 1)
            ->where('enrollments.student_id', $this->id)
            ->first();
    }

    public function getStudentInfoAttribute()
    {
        return Enrollment::select('enrollments.grade_level', 'strands.strand', 'strands.description','enrollments.created_at')
            ->leftjoin('strands', 'enrollments.strand_id', 'strands.id')
            ->join('school_years', 'enrollments.school_year_id', 'school_years.id')
            // ->where('school_years.status', 1)
            ->where('enrollments.student_id', $this->id)
            ->latest()
            ->first();
    }
}
