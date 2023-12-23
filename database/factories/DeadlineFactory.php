<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deadline>
 */
class DeadlineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'what' => $this->faker->sentence,
            'end_date' => $this->faker->dateTimeBetween('+1 week', '+1 year'),
            // 'space_id' and 'project_id' are set in the DatabaseSeeder
        ];
    }
}
