<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'status' => fake()->randomElement(['created', 'active', 'completed']),
            'class' => fake()->optional()->word(),
            'remark' => fake()->optional()->sentence(),
            'code' => fake()->unique()->numberBetween(100000, 999999),
            'password' => fake()->optional()->word(),
            'survey_id' => fake()->numberBetween(1, 10),
        ];
    }
}
