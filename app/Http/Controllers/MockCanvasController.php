<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as JsonResponseAlias;

class MockCanvasController extends Controller
{
    public function getCourseUsers($courseId): JsonResponseAlias
    {
        $users = [];

        for ($i = 1; $i <= 20; $i++) {
            $access_card_id = rand(10000000, 99999999);

            // Check if a user with the same access card ID already exists
            $existingUser = User::where('access_card_id', $access_card_id)->first();

            if (!$existingUser) {
                // If the user does not exist, create a new user
                $users[] = [
                    'name' => 'User ' . $i,
                    'email' => 'user' . $i . '@example.com',
                    'role' => 'student',
                    'access_card_id' => $access_card_id,
                    // Add more properties as needed
                ];
            }
        }

        return response()->json($users);
    }
}
