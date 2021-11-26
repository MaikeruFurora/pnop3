<?php

namespace App\Http\Controllers;

use App\Exports\EnrollmentExport;
use App\Exports\EnrollmentMasterList;
use App\Exports\GradingExport;
use App\Exports\FormExport;
use App\Models\Section;
use App\Models\Subject;
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

    public function exportMasterList($schoolyear,$level){
        return Excel::download(new EnrollmentMasterList($schoolyear,$level), 'Enrollment-Masterlist-'.date("F_d_Y").'.xlsx');
    }

    public function exportMyTemplate(Section $section,Subject $subject,$type){
        return Excel::download(new GradingExport($section->id,$subject->id,$type), strtoupper($section->section_name.'-'.$section->grade_level).'-'.strtoupper($subject->descriptive_title).'-'.date("F_d_Y").'.xlsx');
    }

    public function exportEnrollmentForm($tracking_no){
        return Excel::download(new FormExport($tracking_no), 'Enrollment-Form-'.date("F_d_Y").'.pdf');
    }
}
