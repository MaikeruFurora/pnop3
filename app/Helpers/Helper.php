<?php

namespace App\Helpers;

use App\Models\SchoolYear;
use Illuminate\Support\Facades\Config;

class Helper
{
    public static function create_password($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }

    public static function create_username($fn, $ln)
    {
        return strtolower(substr($fn, 0, 3) . $ln);
    }

    public static function create_roll_no()
    {
        return mt_rand(1000, 9999) . mt_rand(1000, 9999);
    }

    public static function activeAY()
    {
        return SchoolYear::where('status', 1)->first();
    }

    public static function activeTerm()
    {
        if (Config::get('activeAY')->first_term == 'Yes') {
            return '1st';
        }

        if (Config::get('activeAY')->second_term == 'Yes') {
            return '2nd';
        }
    }
}
