<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Application;
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
        //pivot table!
        $users= User::factory(10)->create();
        $projects= Project::factory(5)->create();

        Space::factory(2)->create();
        Application::factory(5)->create();
        user::factory(5)->create();

        //data in pivot table user_project
        foreach ($users as $user) {
            $user->projects()->attach(
                $projects->random(rand(1, 5))->pluck('id')->toArray()
            );
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
