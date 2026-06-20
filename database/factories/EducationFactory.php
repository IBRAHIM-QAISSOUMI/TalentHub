<?php

namespace Database\Factories;

use App\Models\Education;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'school' => fake()->company(),
            'degree' => fake()->randomElement([
                'Software Engineering',
                'Computer Science',
                'Web Development',
                'Information Technology'
            ]),
            'start_year' => fake()->numberBetween(2018, 2025),
            'end_year' => fake()->optional()->numberBetween(2022, 2028),
        ];
    }
}