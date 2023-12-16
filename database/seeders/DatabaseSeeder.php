<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //pivot table! 
        $users=\App\Models\User::factory(10)->create();
        $projects=\App\Models\Project::factory(5)->create();

        \App\Models\Space::factory(2)->create();
        \App\Models\Application::factory(5)->create();
        \App\Models\user::factory(5)->create();

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
