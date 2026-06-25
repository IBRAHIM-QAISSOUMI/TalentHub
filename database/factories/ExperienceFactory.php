<?php

namespace Database\Factories;

use App\Models\Experience;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'company' => fake()->company(),
            'position' => fake()->jobTitle(),
            'start_date' => fake()->date(),
            'end_date' => fake()->optional()->date(),
        ];
    }
}