<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RemarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => fake()->sentence(),
            'status' => fake()->randomElement(['positive', 'negative', 'neutral']),
            'private' => fake()->boolean(),
            'ip_address' => fake()->ipv4(),
            'session_id' => fake()->numberBetween(1, 20),
        ];
    }
}
