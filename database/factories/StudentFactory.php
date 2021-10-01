<?php

namespace Database\Factories;

use App\Models\Student;
use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'roll_no' => 1129 . Helper::create_roll_no(),
            // 'curriculum' => $this->faker->randomElement($array = array('BEC', 'STEM', 'SPA', 'SPJ')),
            'student_firstname' => $this->faker->firstName(),
            'student_middlename' => $this->faker->lastName(),
            'student_lastname' => $this->faker->lastName(),
            'date_of_birth' => $this->faker->date(),
            'student_contact' => '09277422150',
            'gender' => $this->faker->randomElement($array = array('Male', 'Female')),
            'region' => 'REGION V (BICOL REGION)',
            'province' => 'CAMARINES SUR',
            'city' => $this->faker->randomElement($array = array('PILI (Capital)', 'BULA')),
            'barangay' => $this->faker->randomElement($array = array('San Vicente', 'Anayan', 'Pawili', 'Old San Roque', 'San Juan')),
            'last_school_attended' => $this->faker->address(),
            'mother_name' => $this->faker->name(),
            'mother_contact_no' => '09277422150',
            'father_name' => $this->faker->name(),
            'father_contact_no' => '09277422150',
            'guardian_name' => $this->faker->name(),
            'guardian_contact_no' => '09277422150',
            'username' => Helper::create_username($this->faker->lastName(), $this->faker->lastName()),
            'orig_password' => Crypt::encrypt('pnhs'),
            'password' => '$2y$10$p6lwjObc4DNSy3VaXeqNcu9XBf1W9FYQ2CD0tpihuiXlmvahnCnTW',
            'student_status' => null,
            'completer' => 'No',
        ];
    }
}
