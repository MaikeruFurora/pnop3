<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackSubject extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
