<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                'grade_level' => 7,
                'subject_code' => 'FIL-07',
                'descriptive_title' => 'Filipino',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 7,
                'subject_code' => 'ENG-07',
                'descriptive_title' => 'English',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 7,
                'subject_code' => 'MATH-07',
                'descriptive_title' => 'Mathematics',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 7,
                'subject_code' => 'SCI-07',
                'descriptive_title' => 'Science and Technology',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 7,
                'subject_code' => 'AP-07',
                'descriptive_title' => 'Araling Panlipunan',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 7,
                'subject_code' => 'EsP-07',
                'descriptive_title' => 'Edukasyon sa Pagpapakatao',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 7,
                'subject_code' => 'TLE-07',
                'descriptive_title' => 'Technology and Livelihood Education',
                'subject_for' => 'BEC'
            ],
            [
                'grade_level' => 7,
                'subject_code' => 'MAPEH-07',
                'descriptive_title' => 'Music, Arts, Physical Education, and Health',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 7,
                'subject_code' => 'RSTE-07',
                'descriptive_title' => 'Research I',
                'subject_for' => 'STEM'
            ],
            //for grade 8
            [
                'grade_level' => 8,
                'subject_code' => 'FIL-08',
                'descriptive_title' => 'Filipino',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 8,
                'subject_code' => 'ENG-08',
                'descriptive_title' => 'English',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 8,
                'subject_code' => 'MATH-08',
                'descriptive_title' => 'Mathematics',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 8,
                'subject_code' => 'SCI-08',
                'descriptive_title' => 'Science and Technology',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 8,
                'subject_code' => 'AP-08',
                'descriptive_title' => 'Araling Panlipunan',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 8,
                'subject_code' => 'EsP-08',
                'descriptive_title' => 'Edukasyon sa Pagpapakatao',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 8,
                'subject_code' => 'TLE-08',
                'descriptive_title' => 'Technology and Livelihood Education',
                'subject_for' => 'BEC'
            ],
            [
                'grade_level' => 8,
                'subject_code' => 'MAPEH-08',
                'descriptive_title' => 'Music, Arts, Physical Education, and Health',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 8,
                'subject_code' => 'RSTE-08',
                'descriptive_title' => 'Research II',
                'subject_for' => 'STEM'
            ],

            //subject 9
            [
                'grade_level' => 9,
                'subject_code' => 'FIL-09',
                'descriptive_title' => 'Filipino',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 9,
                'subject_code' => 'ENG-09',
                'descriptive_title' => 'English',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 9,
                'subject_code' => 'MATH-09',
                'descriptive_title' => 'Mathematics',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 9,
                'subject_code' => 'SCI-09',
                'descriptive_title' => 'Science and Technology',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 9,
                'subject_code' => 'AP-09',
                'descriptive_title' => 'Araling Panlipunan',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 9,
                'subject_code' => 'EsP-09',
                'descriptive_title' => 'Edukasyon sa Pagpapakatao',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 9,
                'subject_code' => 'TLE-09',
                'descriptive_title' => 'Technology and Livelihood Education',
                'subject_for' => 'BEC'
            ],
            [
                'grade_level' => 9,
                'subject_code' => 'MAPEH-09',
                'descriptive_title' => 'Music, Arts, Physical Education, and Health',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 9,
                'subject_code' => 'RSTE-09',
                'descriptive_title' => 'Chemistry',
                'subject_for' => 'STEM'
            ],

            // suject for 10

            [
                'grade_level' => 10,
                'subject_code' => 'FIL-10',
                'descriptive_title' => 'Filipino',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 10,
                'subject_code' => 'ENG-10',
                'descriptive_title' => 'English',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 10,
                'subject_code' => 'MATH-10',
                'descriptive_title' => 'Mathematics',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 10,
                'subject_code' => 'SCI-10',
                'descriptive_title' => 'Science and Technology',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 10,
                'subject_code' => 'AP-10',
                'descriptive_title' => 'Araling Panlipunan',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 10,
                'subject_code' => 'EsP-10',
                'descriptive_title' => 'Edukasyon sa Pagpapakatao',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 10,
                'subject_code' => 'TLE-10',
                'descriptive_title' => 'Technology and Livelihood Education',
                'subject_for' => 'BEC'
            ],
            [
                'grade_level' => 10,
                'subject_code' => 'MAPEH-10',
                'descriptive_title' => 'Music, Arts, Physical Education, and Health',
                'subject_for' => 'GENERAL'
            ],
            [
                'grade_level' => 10,
                'subject_code' => 'RSTE-10',
                'descriptive_title' => 'Electronics and Robotics',
                'subject_for' => 'STEM'
            ],

            // ------------- SENIOR HIGH SUBJECT
            [
               
                'term'=>'1st',
                'grade_level' => 11,
                'indicate_type' => 'Core',
                'subject_code' => 'OA-03',
                'descriptive_title' => 'Oral Communication',
            ],
          

            ////////////////////////////////////////////
            // Reading and Writing
            ///////////////////////////////////////////

            [
               
                'term'=>'2nd',
                'grade_level' => 11,
                'indicate_type' => 'Core',
                'subject_code' => 'RW-06',
                'descriptive_title' => 'Reading and Writing',
            ],
            
            ////////////////////////////////////////////
            // Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino
            ///////////////////////////////////////////

            
            [
               
                'term'=>'1st',
                'grade_level' => 11,
                'indicate_type' => 'Core',
                'subject_code' => 'FILSHS-07',
                'descriptive_title' => 'Komunikasyon at Pananaliksik sa Wika at Kulturang Pilipino',
            ],
            
            
             ////////////////////////////////////////////
            // Pagbasa at Pagsusuri ng Iba’t-Ibang Teksto Tungo sa Pananaliksik
            ////////////////////////////////////////////


            [
               
                'term'=>'2nd',
                'grade_level' => 11,
                'indicate_type' => 'Core',
                'subject_code' => 'PPTP-08',
                'descriptive_title' => 'Pagbasa at Pagsusuri ng Iba’t-Ibang Teksto Tungo sa Pananaliksik',
            ],


            ////////////////////////////////////////////
            // 21st Century Literature from the Philippines and the World
            ///////////////////////////////////////////

            [
               
                'term'=>'2nd',
                'grade_level' => 11,
                'indicate_type' => 'Core',
                'subject_code' => 'CLPW-05',
                'descriptive_title' => '21st Century Literature from the Philippines and the World',
            ],

            ////////////////////////////////////////////
            // Contemporary Philippine Arts from the Regions
            ///////////////////////////////////////////

            [
               
                'term'=>'1st',
                'grade_level' => 12,
                'indicate_type' => 'Core',
                'subject_code' => 'CPAR-04',
                'descriptive_title' => 'Contemporary Philippine Arts from the Regions',
            ],
            ////////////////////////////////////////////
            // Media and Information Literacy
            ///////////////////////////////////////////

            [
               
                'term'=>'2nd',
                'grade_level' => 12,
                'indicate_type' => 'Core',
                'subject_code' => 'MIL-12',
                'descriptive_title' => 'Media and Information Literacy',
            ],

            ////////////////////////////////////////////
            // General Mathematics
            ///////////////////////////////////////////

            [
               
                'term'=>'1st',
                'grade_level' => 11,
                'indicate_type' => 'Core',
                'subject_code' => 'GM-02',
                'descriptive_title' => 'General Mathematics',
            ],


             ////////////////////////////////////////////
            // Statistics and Probability
            ///////////////////////////////////////////

            [
               
                'term'=>'2nd',
                'grade_level' => 11,
                'indicate_type' => 'Core',
                'subject_code' => 'SP-09',
                'descriptive_title' => 'Statistics and Probability',
            ],
             ////////////////////////////////////////////
            // Earth and Life Science
            ///////////////////////////////////////////

            [
               
                'term'=>'1t',
                'grade_level' => 12,
                'indicate_type' => 'Core',
                'subject_code' => 'CEA-01',
                'descriptive_title' => 'Earth and Life Science',
            ],

             ////////////////////////////////////////////
            // Physical Education and Health PE-1
            ///////////////////////////////////////////

             [
               
                'term'=>'1st',
                'grade_level' => '11',
                'indicate_type' => 'Core',
                'subject_code' => 'PE-1',
                'descriptive_title' => 'Physical Education and Health',
            ],


             ////////////////////////////////////////////
            // Physical Education and Health PE-2
            ///////////////////////////////////////////

            [
               
                'term'=>'2nd',
                'grade_level' => '11',
                'indicate_type' => 'Core',
                'subject_code' => 'PE-2',
                'descriptive_title' => 'Physical Education and Health',
            ],
         

             ////////////////////////////////////////////
            // Physical Education and Health PE-3
            ///////////////////////////////////////////

            [
               
                'term'=>'1st',
                'grade_level' => '12',
                'indicate_type' => 'Core',
                'subject_code' => 'PE-3',
                'descriptive_title' => 'Physical Education and Health',
            ],
            

             ////////////////////////////////////////////
            // Physical Education and Health PE-2
            ///////////////////////////////////////////

            [
               
                'term'=>'2nd',
                'grade_level' => '12',
                'indicate_type' => 'Core',
                'subject_code' => 'PE-4',
                'descriptive_title' => 'Physical Education and Health',
            ],
            ////////////////////////////////////////////

            
          
         
    
           
       
            // [
            //     'indicate_type' => 'Core',
            //     'subject_code' => 'IPHP-11',
            //     'descriptive_title' => 'Introduction to the Philosophy of the Human Person',
            // ],
         
            // [
            //     'indicate_type' => 'Core',
            //     'subject_code' => 'UCSP-13',
            //     'descriptive_title' => 'Understanding Culture, Society and Politics',
            // ],
            // [
            //     'indicate_type' => 'Core',
            //     'subject_code' => 'EAS-14',
            //     'descriptive_title' => 'Earth and Science',
            // ],
            // [
            //     'indicate_type' => 'Core',
            //     'subject_code' => 'DRRR-15',
            //     'descriptive_title' => 'Disaster Readiness and Risk Reduction',
            // ],
            // [
            //     'indicate_type' => 'Core',
            //     'subject_code' => 'PD-16',
            //     'descriptive_title' => 'Personal Development',
            // ],
            // [
            //     'grade_level' => '11',
            //     'strand_id' => '3',
            //     'indicate_type' => 'Specialized',
            //     'subject_code' => 'PRECAL-01',
            //     'descriptive_title' => 'Pre-Calculus',
            // ],
            // [
            //     'grade_level' => '11',
            //     'strand_id' => '3',
            //     'indicate_type' => 'Specialized',
            //     'subject_code' => 'BCAL-02',
            //     'descriptive_title' => 'Basic Calculus',
            // ],

        ];

        foreach ($subjects as $value) {
            Subject::create($value);
        }
    }
}
