<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    use HasFactory;
    protected $fillable = [
        'from',
        'to',
        'status',
    ];

    public function school_year()
    {
        return $this->hasMany(Section::class);
    }
}
