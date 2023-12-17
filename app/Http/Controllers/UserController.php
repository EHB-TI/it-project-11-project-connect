<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Application;
use App\Models\User;



class UserController extends Controller
{
    public function findMyProjectsAndApplications(){
       
        
    }

    public function index(){
        $users = User::with('projects')->get();
        return view('students.index',['users' => $users]);
    }

    public function findProjectsAndApplications(){
        $publishedProjects = Project:: where('status', 'published')->get();
        $approvedProjects = Project:: where('status', 'approved')->get();
        $closedProjects = Project:: where('status', 'closed')->get();
        $deniedProjects = Project:: where('status', 'denied')->get();
        $pendingProjects = Project:: where('status', 'pending')->get();

    // dd($closedProjects);

        $applications = Application::all();
        //where('applicant_id', $user_id);
        
        return view('dashboard', [
            'pendingProjects' => $pendingProjects, 
            'publishedProjects' => $publishedProjects, 
            'approvedProjects' => $approvedProjects, 
            'closedProjects' => $closedProjects,
            'deniedProjects' => $deniedProjects
        ]);
        
    }

    public function show($id){
        $user = User::find($id);
        return view('students.show', ['user' => $user]);
    }
}
