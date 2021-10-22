<?php

namespace App\Exports;

use App\Models\Enrollment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

class FormExport implements FromView,ShouldAutoSize,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(string $tracking_no)
    {
        $this->tracking_no = $tracking_no;
    }
    public function view(): View
    {
        $data=Enrollment::join('students','enrollments.student_id','students.id')
        ->where('enrollments.tracking_no',$this->tracking_no)
        ->first();

        return view('form/partial/downloadForm',compact('data'));
    }

    public function styles($sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true,'size' => 9]],
            2    => ['font' => ['bold' => true,'size' => 15]],
            3    => ['font' => ['bold' => true,'size' => 9]],
            4    => ['font' => ['bold' => true,'size' => 9]],
            5    => ['font' => ['bold' => true,'size' => 9]],
            6    => ['font' => ['bold' => true,'size' => 9]],
            7    => ['font' => ['bold' => true,'size' => 9]],
            8    => ['font' => ['bold' => true,'size' => 9]],
            9    => ['font' => ['bold' => true,'size' => 9]],
            10    => ['font' => ['bold' => true,'size' => 9]],
            11    => ['font' => ['bold' => true,'size' => 9]],
            12    => ['font' => ['bold' => true,'size' => 9]],
            13    => ['font' => ['bold' => true,'size' => 9]],
            14    => ['font' => ['bold' => true,'size' => 9]],
            15    => ['font' => ['bold' => true,'size' => 9]],
            16    => ['font' => ['bold' => true,'size' => 9]],
            17    => ['font' => ['bold' => true,'size' => 9]],
            18    => ['font' => ['bold' => true,'size' => 9]],
            19    => ['font' => ['bold' => true,'size' => 9]],

            // Styling a specific cell by coordinate.
            // 'A1:B1' => ['font' => ['italic' => true]],
            // 'A2:B2' => ['font' => ['italic' => true]],
            // 'A3:B3' => ['font' => ['italic' => true]],

            // Styling an entire column.
        //    'C'  => ['font' => ['size' => 14]],
        ];
    }
}
