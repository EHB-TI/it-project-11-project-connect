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
        $user_ids = User::pluck('id')->toArray();
        $applicant_id = $this->faker->randomElement($user_ids);

        return [
            'motivationContent' => $this->faker->text(),
            'status' => $this->faker->randomElement(['approved', 'denied', 'pending']),
            'reason' => $this->faker->text(),
            'applicant_id' => $applicant_id,
        ];
    }
}
