<?php

namespace App\Imports;

use App\Models\Grade;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

use function PHPUnit\Framework\isNull;

class GradingImport implements ToCollection,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct(int $section, int $subject, string $type)
    {
        $this->section = $section;
        $this->subject = $subject;
        $this->type = $type;
    }


    public function collection(Collection $rows)
    {
        $d1=null;
        $d2=null;
        $d3=null;
        $d4=null;
        $d5=null;
        if ($this->type=="jhs") {
             foreach($rows as $row){

           if (!empty($row[0])) {
            $data= Grade::join('students','grades.student_id','students.id')
            ->where('students.roll_no',$row[0])
            ->where('grades.section_id',$this->section)
            ->where('grades.subject_id',$this->subject)
            ->first();
            
             if (!empty($row[2])) {
                 $d1=$row[2];
             }
             if (!empty($row[3])) {
                 $d2=$row[3];
             }
             if (!empty($row[4])) {
                 $d3=$row[4];
             }
             if (!empty($row[5])) {
                 $d4=$row[5];
             }
             if (!empty($row[6])) {
                 $d5=$row[6];
             }
             
              Grade::join('students','grades.student_id','students.id')
             ->where('students.roll_no',$row[0])
             ->where('grades.section_id',$this->section)
             ->where('grades.subject_id',$this->subject)
             ->update([
                 'grades.first'=>$d1 ?? $data->first,
                 'grades.second'=>$d2 ?? $data->second,
                 'grades.third'=>$d3 ?? $data->third,
                 'grades.fourth'=>$d4 ?? $data->fourth,
                 'grades.avg'=>(!empty($d5))? $d5 :((!empty($d1) && !empty($d2) && !empty($d3) && !empty($d4))? round(($d1+$d2+$d3+$d4)/4) : $data->avg)
             ]);
        
        }
       }
        } else {
             foreach($rows as $row){
                    if (!empty($row[0])) {
                        $data= Grade::join('students','grades.student_id','students.id')
                        ->where('students.roll_no',$row[0])
                        ->where('grades.section_id',$this->section)
                        ->where('grades.subject_id',$this->subject)
                        ->first();
                        
                        if (!empty($row[2])) {
                            $d1=$row[2];
                        }
                        if (!empty($row[3])) {
                            $d2=$row[3];
                        }
                        if (!empty($row[4])) {
                            $d5=$row[4];
                        }
                        
                        Grade::join('students','grades.student_id','students.id')
                        ->where('students.roll_no',$row[0])
                        ->where('grades.section_id',$this->section)
                        ->where('grades.subject_id',$this->subject)
                        ->update([
                            'grades.first'=>$d1 ?? $data->first,
                            'grades.second'=>$d2 ?? $data->second,
                            'grades.avg'=>(!empty($d5))? $d5 :((!empty($d1) && !empty($d2))? round(($d1+$d2)/2) : $data->avg)
                        ]);
                    
                    }
            }
        }
        
    }

    // public function model(array $row)
    // {
    //     return $row[0];
    //        return  Grade::join('students','grades.student_id','students.id')
    //         ->where('students.roll_no',$row[0])
    //         ->where('grades.section_id',$this->section)
    //         ->where('grades.subject_id',$this->subject)
    //         ->update([
    //             'grades.first'=>$row[2] ?? null,
    //             'grades.second'=>$row[3] ?? null,
    //             'grades.third'=>$row[4] ?? null,
    //             'grades.fourth'=>$row[5] ?? null
    //         ]);
       
    // }
    
    public function startRow(): int
    {
        return 6;
    }
}
