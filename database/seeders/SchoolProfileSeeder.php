<?php

namespace Database\Seeders;

use App\Models\SchoolProfile;
use Illuminate\Database\Seeder;

class SchoolProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $schoolProfile = [
            'school_id_no' => '302017',
            'school_name' => 'PILI NATIONAL HIGH SCHOOL',
            'school_region' => 'BICOL REGION',
            'school_division' => 'DIVISON V',
            'school_address' => 'PAWILI, PILI CAMARINES SUR',
            'school_enrollment_url' => '1',
        ];

        SchoolProfile::create($schoolProfile);
    }
}
