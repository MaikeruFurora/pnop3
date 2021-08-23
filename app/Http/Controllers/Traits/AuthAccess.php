<?php

namespace App\Http\Controllers\Traits;

/**
 * 
 */
trait AuthAccess
{

    public function forbidden()
    {
        return view('auth/forbidden');
    }
}
