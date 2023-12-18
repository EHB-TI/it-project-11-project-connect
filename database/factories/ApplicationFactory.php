<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

/**
 * @extends Factory<Application>
 */
class ApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_ids = User::pluck('id')->toArray();
        $project_ids = Project::pluck('id')->toArray();
        $user_id = $this->faker->randomElement($user_ids);
        $project_id = $this->faker->randomElement($project_ids);

        return [
            'motivation' => $this->faker->text(),
            'status' => $this->faker->randomElement(['approved', 'denied', 'pending']),
            'reason' => $this->faker->text(),
            'user_id' => $user_id,
            'project_id' => $project_id,
        ];
    }
}
