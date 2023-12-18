<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends Factory<Model>
 */
class ProjectUserFactory extends Factory
{

   /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /*
     public function definition(): array
     {

         $user_ids = User::pluck('id')->toArray();
         $projectIds = Project::pluck('id')->toArray();

         return [
             'user_id' => $this->faker->randomElement($user_ids),
             'project_id' => $this->faker->randomElement($projectIds),

         ];
     }
    */
}
