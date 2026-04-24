<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Survey;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => fake()->randomElement(['active', 'completed']),
            'class' => fake()->optional()->word(),
            'remark' => fake()->optional()->sentence(),
            'code' => fake()->unique()->numberBetween(100000, 999999),
            'survey_id' => Survey::factory(),
        ];
    }
}
