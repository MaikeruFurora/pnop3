<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Teacher extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // protected $fillable = [
    //     'roll_no',
    //     'teacher_firstname',
    //     'teacher_middlename',
    //     'teacher_lastname',
    //     'teacher_gender',
    //     'username',
    //     'orig_password',
    //     'password',
    // ];

    protected $guarded = [];
    protected $date = ['deleted_at'];
    protected $hidden = [
        'orig_password',
        'password',
    ];

    protected $casts = [
        'roll_no' => 'integer',
        'username' => 'string',
    ];

    public function getRollNoAttribute($value)
    {
        return intval($value);
    }

    public function getTeacherFirstnameAttribute($value)
    {
        return ucfirst($value);
    }
    public function getTeacherLastnameAttribute($value)
    {
        return ucfirst($value);
    }
    public function getTeacherMiddlenameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFullNameAttribute()
    {
        return ucwords("{$this->teacher_firstname} {$this->teacher_lastname}");
    }


    public function section()
    {
        return $this->hasOne(Section::class);
    }

    public function chairman()
    {
        return $this->hasOne(Chairman::class);
    }

    public function assign()
    {
        return $this->hasMany(Assign::class);
    }

    public function newassign()
    {
        return $this->hasMany(Newassign::class);
    }

    public function getChairmanInfoAttribute()
    {
        return Chairman::select('grade_level')->join('teachers', 'chairmen.teacher_id', 'teachers.id')
            ->join('school_years', 'chairmen.school_year_id', 'school_years.id')
            ->where('school_years.status', 1)
            ->where('teacher_id', $this->id)->first();
    }

    public function getSectionInfoAttribute()
    {
        return Section::select('sections.id', 'sections.grade_level', 'sections.class_type', 'sections.section_name', 'strands.strand')->join('teachers', 'sections.teacher_id', 'teachers.id')
            ->leftjoin('strands', 'sections.strand_id', 'strands.id')
            ->join('school_years', 'sections.school_year_id', 'school_years.id')
            ->where('school_years.status', 1)
            ->where('teacher_id', $this->id)->first();
    }

    public function getAssignInfoAttribute()
    {
        return Assign::select('assigns.grade_level', 'sections.class_type', 'sections.section_name')
            ->join('teachers', 'assigns.teacher_id', 'teachers.id')
            ->leftjoin('subjects', 'assigns.subject_id', 'subjects.id')
            ->leftjoin('sections', 'assigns.section_id', 'sections.id')
            ->join('school_years', 'assigns.school_year_id', 'school_years.id')
            ->where('school_years.status', 1)
            ->where('assigns.teacher_id', $this->id)->get();
    }


    // public function getNewassignInfoAttribute()
    // {
    //     return Assign::select('newassigns.grade_level', 'sections.class_type', 'sections.section_name')
    //         ->join('teachers', 'newassigns.teacher_id', 'teachers.id')
    //         ->leftjoin('subjects', 'newassigns.subject_id', 'subjects.id')
    //         ->leftjoin('sections', 'newassigns.section_id', 'sections.id')
    //         ->join('school_years', 'newassigns.school_year_id', 'school_years.id')
    //         ->where('school_years.status', 1)
    //         ->where('assigns.teacher_id', $this->id)->get();
    // }
}
