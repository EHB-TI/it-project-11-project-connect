<?php

namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Space>
 */
class SpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $spaceNames = [
            'IT Prroject 2023 - 2024',
            'Java Advanced Short burst project',
            'Backend Web Laravel project',
            'backand web node.js project',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($spaceNames),
            'defaultTeamSize' => 5,
        ];
    }
}
