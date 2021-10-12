<?php

namespace App\Http\Controllers;

use App\Imports\GradingImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function importMyTemplate($section,$subject,$type,Request $request){
        $file=$request->file('file');
         Excel::import(new GradingImport($section,$subject,$type),$file);
    }
}
