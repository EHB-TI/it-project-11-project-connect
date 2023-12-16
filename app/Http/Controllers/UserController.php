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
        $projects = Project::where('status', 'published')
                            ->where('ownerID', $userId)
                            ->with('owner')
                            ->get();

        $applications = Application::where('applicantID', $userId);
        
        return view('students/dashboard', ['projects' => $projects, 'applications' => $applications]);
        //same should be done for applications or just add an applicant variable
        
    }

    public function index(){
        $users = User::with('projects')->get();
        return view('teachers.studentsOverview',['users' => $users]);
    }

    public function findProjectsAndApplications(){
        $projects = Project::all();
        // where('status', 'published')
        //                     ->where('ownerID', $userId)
        //                     ->with('owner')
        //                     ->get();

        $applications = Application::all();
        //where('applicantID', $userId);
        
        return view('teachers/dashboard', ['projects' => $projects, 'applications' => $applications]);
        //same should be done for applications or just add an applicant variable
        
    }

    public function show($id){
        $user = User::find($id);
        return view('teachers.userInformation', ['user' => $user]);
    }
}
