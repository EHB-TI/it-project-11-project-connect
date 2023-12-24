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

        // Create 5 students
        User::factory(5)->state(['role' => 'student'])->create();

        // Create 3 teachers
        User::factory(3)->state(['role' => 'teacher'])->create();

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
            $projectIds = Project::all()->random(rand(1, 5))->pluck('id')->toArray();

            foreach ($projectIds as $projectId) {
                $project = Project::find($projectId);
                $userProjectsInSameSpace = $user->projects()->where('space_id', $project->space_id)->get();

                if ($userProjectsInSameSpace->isEmpty()) {
                    $user->projects()->attach($projectId);
                }
            }
        }

        // Get all students and teachers
        $students = User::where('role', 'student')->get();
        $teachers = User::where('role', 'teacher')->get();

        // Attach students and at least one teacher to each space
        foreach ($spaces as $space) {
            $space->users()->attach(
                $students->random(rand(1, 5))->pluck('id')->toArray()
            );

            $space->users()->attach(
                $teachers->random(1)->pluck('id')->toArray()
            );
        }
    }
}
