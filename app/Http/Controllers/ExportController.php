<?php

namespace App\Http\Controllers;

use App\Exports\EnrollmentExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportNewEnrollee($format, $status, $curriculum, $grade_level)
    {
        if ($format == '.pdf') {
            // return TCPDF::
        } else {
            return Excel::download(new EnrollmentExport($status, $curriculum, $grade_level), strtoupper($curriculum) . '-' . date("F_d_Y") . $format);
        }
    }
}
