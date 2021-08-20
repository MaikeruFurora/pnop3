<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_level',
        'subject_code',
        'descriptive_title',
        'subject_for'
    ];

    // public function subject()
    // {
    //     return $this->belongsTo(Subject::class);
    // }
}
