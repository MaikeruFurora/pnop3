<?php

namespace Database\Factories;

use App\Helpers\Helper;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class TeacherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teacher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'roll_no' => Helper::create_roll_no(),
            'teacher_firstname' => $this->faker->firstName(),
            'teacher_middlename' => $this->faker->lastName(),
            'teacher_lastname' => $this->faker->lastName(),
            'teacher_gender' => $this->faker->randomElement($array = array('Male', 'Female')),
            'username' => Helper::create_username($this->faker->firstName(), $this->faker->lastName()),
            'password' => Hash::make('pnhs'),
            'orig_password' => Crypt::encrypt('pnhs'),
        ];
    }
}
