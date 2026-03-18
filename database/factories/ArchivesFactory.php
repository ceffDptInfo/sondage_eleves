<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Archives>
 */
class ArchivesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_name' => $this->faker->word() . '.pdf',
            'adding_date' => $this->faker->dateTimeThisYear(),
            'teacher_name' => $this->faker->name(),
            'teacher_email' => $this->faker->email(),
            'survey_name' => $this->faker->sentence(1),
            'survey_description' => $this->faker->paragraph(),
            'survey_question' => $this->faker->sentence(),
            'session_class' => $this->faker->word(),
            'session_remark' => $this->faker->sentence(),
        ];
    }
}
