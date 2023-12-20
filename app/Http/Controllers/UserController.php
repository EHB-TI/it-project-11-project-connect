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
        $users = User::where('role', 'student')->get();
        return view('students.index', ['users' => $users]);
    }

    public function findProjectsAndApplications(){
        $publishedProjects = Project:: where('status', 'published')->get();
        $approvedProjects = Project:: where('status', 'approved')->get();
        $closedProjects = Project:: where('status', 'closed')->get();
        $deniedProjects = Project:: where('status', 'denied')->get();
        $pendingProjects = Project:: where('status', 'pending')->get();

    // dd($closedProjects);
        $users = User::where('isProductOwner', true)->count();    
        $applicants = Application::groupBy('user_id')->count();
        $inactiveStudents = User::all()->count() - $applicants - $users;
        dd(User::all()->count(), $applicants, $users, $inactiveStudents);
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
        $application = Application::find($user->id);

        return view('students.show', ['user' => $user, 'application' => $application]);
       
    }
}
