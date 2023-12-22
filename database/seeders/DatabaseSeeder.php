<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Application;
use App\Models\Deadline;
use App\Models\Project;
use App\Models\Space;
use App\Models\user;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $spaces = Space::factory(4)->create();
        User::factory(5)->create();

        // Ensure at least one project with status 'published' in each space
        foreach ($spaces as $space) {
            $project = Project::factory()->state(['status' => 'published', 'space_id' => $space->id])->create();

            // Create two deadlines for each project
            Deadline::factory()->state(['what' => 'Create Project', 'space_id' => $space->id])->create();
            Deadline::factory()->state(['what' => 'Apply For Projects', 'space_id' => $space->id])->create();
        }

        // Create remaining projects
        Project::factory(16)->create();

        Application::factory(5)->create();

        // Data in pivot table user_project
        $users = User::all();
        foreach ($users as $user) {
            $user->projects()->attach(
                Project::all()->random(rand(1, 5))->pluck('id')->toArray()
            );
        }
    }
}
