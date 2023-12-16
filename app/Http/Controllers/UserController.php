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
        $userId = auth()->id();
        $projects =  User::find(10)->projects()->where('status', 'approved')->get();
        

        $applications = User::find(3)->applications()->get();
        
        return view('students/dashboard', ['projects' => $projects, 'applications' => $applications]);
        //same should be done for applications or just add an applicant variable
        
    }

    public function findProjectsAndApplications(){
        $publishedProjects = Project:: where('status', 'published')->get();
        $approvedProjects = Project:: where('status', 'approved')->get();
        $closedProjects = Project:: where('status', 'closed')->get();
        $deniedProjects = Project:: where('status', 'denied')->get();
        $pendingProjects = Project:: where('status', 'pending')->get();

    // dd($closedProjects);

        $applications = Application::all();
        //where('applicantID', $userId);
        
        return view('teachers/dashboard', [
            'pendingProjects' => $pendingProjects, 
            'publishedProjects' => $publishedProjects, 
            'approvedProjects' => $approvedProjects, 
            'closedProjects' => $closedProjects,
            'deniedProjects' => $deniedProjects
        ]);
        
    }
}
