<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class DashboardController extends Controller
{
    public function show()
    {
        $user_id = auth()->id();
        $projects =  User::find(10)->projects()->where('status', 'approved')->get();
        

        $applications = User::find(3)->applications()->get();
        
        return view('/dashboard', ['projects' => $projects, 'applications' => $applications]);
    }
}
