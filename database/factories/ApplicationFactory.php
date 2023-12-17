<?php

namespace Database\Factories;

use App\Models\Application;
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
        $userIds = User::pluck('id')->toArray();
        $applicantID = $this->faker->randomElement($userIds);

        return [
            'motivationContent' => $this->faker->text(),
            'status' => $this->faker->randomElement(['approved', 'denied', 'pending']),
            'reason' => $this->faker->text(),
            'applicantID' => $applicantID,
        ];
    }
}
