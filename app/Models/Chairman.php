<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chairman extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }
}
