<?php

namespace App\Exports;

use App\Models\Enrollment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Config;

class EnrollmentMasterList implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $term=null;
        if (Config::get('activeAY')->first_term == 'Yes') {
            $term= '1st';
        }

        if (Config::get('activeAY')->second_term == 'Yes') {
            $term= '2nd';
        }
        
        $data = Enrollment::join("students","enrollments.student_id","students.id")
        ->leftjoin('sections','enrollments.section_id','sections.id')
        ->leftjoin('strands','enrollments.strand_id','strands.id')
        ->where('enrollments.school_year_id', Config::get('activeAY')->id)
        ->orwhere('enrollments.term', $term)
        ->get();

        return $data;
    }

    public function map($data): array
    {
        return [
            $data->roll_no,
            $data->student_lastname.' '.$data->student_firstname.' '.$data->student_middlename,
            $data->date_of_birth,
            $data->gender,
            $data->grade_level,
            $data->strand ?? $data->curriculum,
            $data->last_school_attended,
            $data->date_of_enroll,
            $data->enroll_status,
            $data->isbalik_aral,
            $data->region,
            $data->province,
            $data->city,
            $data->barangay,
        ];
    }

    public function headings(): array
    {
        return [
            'LRN',
            'STUDENT NAME',
            'DATE OF BIRTH',
            'SEX',
            'GRADE LEVEL',
            'CURRICULUM | STRAND',
            'LAST SCHOOL ATTENDED',
            'DATE ENROLLED',
            'STATUS',
            'BALIK ARAL',
            'REGION',
            'PROVINCE',
            'MUNICIPALITY',
            'BARANGAY',
        ];
    }
}
