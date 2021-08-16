<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];

    protected $casts = [
        'roll_no' => 'integer',
        'username' => 'string',
    ];


    public function getFullnameAttribute()
    {
        return ucwords("{$this->student_firstname} {$this->student_lastname}");
    }
}
