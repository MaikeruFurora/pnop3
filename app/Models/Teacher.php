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

    // public function assign()
    // {
    //     return $this->hasOne(Assign::class);
    // }
}
