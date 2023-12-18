<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class DashboardController extends Controller
{
    public function show($space_id)
    {
        $user_id = auth()->id();
    
        // Retrieve projects for the authenticated user in the specified space with 'approved' status
        $projects = User::find($user_id)->projects()->where('status', 'approved')->where('space_id', $space_id)->get();
    
        // Retrieve applications for the authenticated user in the specified space
        $applications = User::find($user_id)->applications()->whereHas('project', function ($query) use ($space_id) {
            $query->where('space_id', $space_id);
        })->get();
    
        return view('/dashboard', ['projects' => $projects, 'applications' => $applications]);
    }
    
}
