<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;

use App\Models\Space;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $userIds = User::pluck('id')->toArray();
        $ownerID = $this->faker->randomElement($userIds);

        $spaces = Space::pluck('id')->toArray();
        $spaceID = $this->faker->randomElement($spaces);

        return [
         'name' => $this->faker->unique()->word,
         'description' => $this->faker->sentence,
         'status' => $this->faker->randomElement(['Pending', 'Approved', 'Denied', 'Closed', 'Published']),
         'ownerID' => $ownerID,
         'spaceID' => $spaceID,
        ];
    }
}
