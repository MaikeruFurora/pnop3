<?php

namespace Database\Seeders;

use App\Models\Strand;
use Illuminate\Database\Seeder;

class StrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $strands = [
            [
                'strand' => 'ABM',
                'description' => 'Accounting Business Management'
            ],
            [
                'strand' => 'GAS',
                'description' => 'General Academic Strand'
            ],
            [
                'strand' => 'STEM',
                'description' => 'Science Technology Engineering and Mathematics'
            ],
            [
                'strand' => 'HUMSS',
                'description' => 'Humanities and Social Sciences Strand'
            ],
            [
                'strand' => 'TVL-CSS',
                'description' => 'Computer System Servicing'
            ],
            [
                'strand' => 'TVL-BPP',
                'description' => 'Bread and Pastrty Production'
            ],
            [
                'strand' => 'TVL-ACP',
                'description' => 'Agri Crop Production'
            ],
            [
                'strand' => 'TVL-Caregiving',
                'description' => 'Caregiving'
            ]
        ];
        foreach ($strands as $item) {
            Strand::create($item);
        }
    }
}
