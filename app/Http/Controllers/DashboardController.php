<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Project;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        $space_id = session('current_space_id');

        $user_id = auth()->id();
    
        $projects = Project::all()->where('space_id', $space_id, 'user_id', $user_id);
    
        return view('/dashboard', ['projects' => $projects]);
    }
    
}
