<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schoolYear = [
            'from' => '2021',
            'to' => '2022',
            'status' => '1',
        ];

        SchoolYear::create($schoolYear);
    }
}
