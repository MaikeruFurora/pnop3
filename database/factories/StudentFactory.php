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
            'roll_no' => Helper::create_roll_no(),
            'curriculum' => $this->faker->randomElement($array = array('BEC', 'STEM', 'SPA', 'SPJ')),
            'student_firstname' => $this->faker->firstName(),
            'student_middlename' => $this->faker->lastName(),
            'student_lastname' => $this->faker->lastName(),
            'date_of_birth' => "July 01,1999",
            'student_contact' => '0984723722748',
            'gender' => $this->faker->randomElement($array = array('Male', 'Female')),
            'address' => $this->faker->address(),
            'mother_name' => $this->faker->name(),
            'mother_contact_no' => '09124121',
            'father_name' => $this->faker->name(),
            'father_contact_no' => '09124121',
            'guardian_name' => $this->faker->name(),
            'guardian_contact_no' => '09124121',
            'status' => '',
            'username' => Helper::create_username($this->faker->firstName(), $this->faker->lastName()),
            'orig_password' => Crypt::encrypt('password'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'student_status' => null,
        ];
    }
}
