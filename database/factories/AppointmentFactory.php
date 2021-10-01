<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fullname' => $this->faker->name(),
            'contact_no' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->email(),
            'address' => $this->faker->address(),
            'purpose' => $this->faker->sentence($nbWords = 5, $variableNbWords = true),
            'set_date' => date("m/") . date("d") . date("/Y"),
            'appoint_no' => rand(99, 100) . '-' . rand(99, 100)
        ];
    }
}
