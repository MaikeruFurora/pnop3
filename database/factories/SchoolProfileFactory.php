<?php

namespace Database\Factories;

use App\Models\SchoolProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SchoolProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'school_id_no' => $this->faker->buildingNumber(),
            'school_name' => 'Pili National High School',
            'school_region' => 'Region V',
            'school_division' => $this->faker->citySuffix(),
            'school_address' => $this->faker->address(),
            'school_logo' => 'pili-national-high-school',
        ];
    }
}
