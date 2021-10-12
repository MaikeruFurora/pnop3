<?php

namespace App\Exports;

use App\Helpers\Helper;
use App\Models\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class GradingExport extends DefaultValueBinder implements  FromView,ShouldAutoSize,WithEvents,WithStyles,WithCustomValueBinder
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use RegistersEventListeners;
    public static $var1;

    public function __construct(int $section, int $subject, string $type)
    {
        $this->section = $section;
        $this->subject = $subject;
        $this->type = $type;
        GradingExport::$var1=$type;
    }

    public function bindValue(Cell $cell, $value)
    {
        if ($cell->getColumn() == 'A') {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }
        // if ($cell->getColumn() == 'B') {
        //     $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

        //     return true;
        // }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
 
    public function view(): View
    {
        $term=Helper::activeTerm();
        $data=null;
        if ($this->type=='jhs') {
            $data=Grade::select(
                "sections.section_name",
                "sections.grade_level",
                "students.roll_no",
                "students.id as sid",
                "grades.id as gid",
                "grades.first",
                "grades.second",
                "grades.third",
                "grades.fourth",
                "grades.avg",
                "subjects.descriptive_title",
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )->join('students', 'grades.student_id', 'students.id')
                ->join('enrollments', 'grades.student_id', 'enrollments.student_id')
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->join('subjects', 'grades.subject_id', 'subjects.id')
                ->where('enrollments.enroll_status', "Enrolled")
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->where('subjects.id', $this->subject)
                ->where('sections.id', $this->section)
                ->get();
                return view('teacher/grading/partial/gradingExportJhs',compact('data'));
        } else {
            $data=Grade::select(
                "sections.section_name",
                "sections.grade_level",
                "students.roll_no",
                "students.id as sid",
                "grades.id as gid",
                "grades.first",
                "grades.second",
                "grades.avg",
                "grades.term",
                "subjects.descriptive_title",
                DB::raw("CONCAT(students.student_lastname,', ',students.student_firstname,' ',students.student_middlename) as fullname")
            )->join('students', 'grades.student_id', 'students.id')
                ->join('enrollments', 'grades.student_id', 'enrollments.student_id')
                ->join('sections', 'enrollments.section_id', 'sections.id')
                ->join('subjects', 'grades.subject_id', 'subjects.id')
                ->where('enrollments.enroll_status', "Enrolled")
                ->where('enrollments.term', $term)
                ->where('enrollments.school_year_id', Helper::activeAY()->id)
                ->where('subjects.id', $this->subject)
                ->where('sections.id', $this->section)
                ->get();
                return view('teacher/grading/partial/gradingExportShs',compact('data'));
        }
        
        
    }


    public static function afterSheet(AfterSheet $event)
    {
        // Create Style Arrays
        $default_font_style = [
            'font' => [ 'size' => 13]
        ];

        $strikethrough = [
            'font' => ['strikethrough' => true],
        ];

        // Get Worksheet
        $active_sheet = $event->sheet->getDelegate();

        // Apply Style Arrays
        $active_sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);
      
        $currentType=GradingExport::$var1;

        if ($currentType=="jhs") {
            $event->sheet->getStyle('A1:G50')->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);

            $event->sheet->getDelegate()->getStyle('A4:F4')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('EEEEEE');
        } else {
            $event->sheet->getStyle('A1:E50')->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ]);

            $event->sheet->getDelegate()->getStyle('A4:E4')
            ->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()
            ->setARGB('EEEEEE');
        }
        
        
        $event->sheet->getDelegate()->getStyle('C4')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

      

        // $event->sheet->getStyle('A1:D1')->getStartColor()->setARGB('ffff15');
        
        // // strikethrough group of cells (A10 to B12) 
        // $active_sheet->getStyle('A10:B12')->applyFromArray($strikethrough);
        // // or
        // $active_sheet->getStyle('A10:B12')->getFont()->setStrikethrough(true);

        // // single cell
        // $active_sheet->getStyle('A13')->getFont()->setStrikethrough(true);
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true,'size' => 13]],
            2    => ['font' => ['bold' => true,'size' => 13]],
            3    => ['font' => ['bold' => true,'size' => 13]],
            4    => ['font' => ['bold' => true,'size' => 13]],
            5    => ['font' => ['bold' => true,'size' => 13]],

            // Styling a specific cell by coordinate.
            'A1:B1' => ['font' => ['italic' => true]],
            'A2:B2' => ['font' => ['italic' => true]],
            'A3:B3' => ['font' => ['italic' => true]],

            // Styling an entire column.
        //    'C'  => ['font' => ['size' => 14]],
        ];
    }
    // public function map($data): array
    // {
    //     return [
    //         $data->roll_no,
    //         $data->fullname,
    //         '',
    //         '',
    //         '',
    //         '',
    //         '',
    //     ];
    // }

    // public function headings(): array
    // {
    //     return [
    //         'LRN',
    //         'STUDENT NAME',
    //         '1st',
    //         '2nd',
    //         '3rd',
    //         '4th',
    //     ];
    // }

}
