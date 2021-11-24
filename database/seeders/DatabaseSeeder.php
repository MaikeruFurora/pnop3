<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(7)->create();
        \App\Models\Appointment::factory(100)->create();
        \App\Models\User::factory()->create();
        \App\Models\Teacher::factory()->count(200)->create();
        $this->call(StrandSeeder::class);
        $this->call(SchoolYearSeeder::class);
        $this->call(SchoolProfileSeeder::class);
        $this->call(SubjectSeeder::class);
    }
}
