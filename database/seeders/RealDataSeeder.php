<?php

namespace Database\Seeders;

use App\Models\Space;
use App\Models\User;
use Illuminate\Database\Seeder;

class RealDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Chris ILUNGA-TSHAMAKEJI', 'role' => 'student', 'available' => true],
            ['name' => 'Bryan LANGHENDRIES', 'role' => 'student', 'available' => true],
            ['name' => 'Abdel LEHHIT', 'role' => 'student', 'available' => true],
            ['name' => 'Gill Mertens', 'role' => 'student', 'available' => true],
            ['name' => 'Lucas Willaert', 'role' => 'student', 'available' => true],
            ['name' => 'Robin Bervoets', 'role' => 'teacher', 'available' => true],
            ['name' => 'Ruben Dejonckheere', 'role' => 'teacher', 'available' => true],
            ['name' => 'Wim Hambrouck', 'role' => 'teacher', 'available' => true],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $this->command->info('Users seeded!');

        // Create the communal space and link all users to it
        $communalSpace = Space::create([
            'name' => 'IT Project 2023 - 2024',
            'canvasCourseId' => 1,
            'defaultTeamSize' => 5, // Adjust as necessary
        ]);

        User::all()->each(function ($user) use ($communalSpace) {
            $communalSpace->users()->attach($user);
        });

        // Create the other spaces and link some users and each respective teacher to them
        $spaces = [
            [
                'name' => 'Java Advanced - Short burst project',
                'teacher' => 'Ruben Dejonckheere',
            ],
            [
                'name' => 'Programming Essentials 2 - Indie Game',
                'teacher' => 'Robin Bervoets',
            ],
            [
                'name' => '.NET Essentials - UI project',
                'teacher' => 'Wim Hambrouck',
            ],
        ];

        // Get all the student users
        $students = User::where('role', 'student')->get();

        foreach ($spaces as $spaceData) {
            $space = Space::create([
                'name' => $spaceData['name'],
                'canvasCourseId' => 1, // Adjust as necessary
                'defaultTeamSize' => 5, // Adjust as necessary
            ]);

            $teacher = User::where('name', $spaceData['teacher'])->first();
            $space->users()->attach($teacher);

            // For each student, randomly decide if they should be attached to this space
            foreach ($students as $student) {
                if (rand(0, 1)) {
                    $space->users()->attach($student);
                }
            }
        }

        $this->command->info('Spaces seeded!');
    }
}
