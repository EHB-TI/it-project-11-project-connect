<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Application;
use App\Models\Project;
use App\Models\Deadline;


class DashboardController extends Controller
{
    public function show(Request $request)
    {
        //GETTING THE DEADLINE INFORMATION
        $space_id = session('current_space_id');
        
        $deadline = Deadline::nextDeadlineForSpace($space_id);
        $user_id = auth()->id();
    
        $projects = Project::all()->where('space_id', $space_id);
        //CHARTS 1 LOGIC 
        $spaceUsers = User::all();
        $po = User::where('isProductOwner', true)->count();    
        $applicants = Application::groupBy('user_id')->count();
        $inactiveStudents = User::all()->count() - $applicants - $po;
        // dd(User::all()->count(), $applicants, $po, $inactiveStudents);


        //CHART 2 LOGIC
        $publishedProjects = Project:: where('status', 'published')->count();
        $approvedProjects = Project:: where('status', 'approved')->count();
        $closedProjects = Project:: where('status', 'closed')->count();
        $deniedProjects = Project:: where('status', 'denied')->count();
        $pendingProjects = Project:: where('status', 'pending')->count();
        $allProjects = Project:: all()->count();

        return view('/dashboard', ['deadline' => $deadline,
            'projects' => $projects, 'applicants' => $applicants, 'allProjects' => $allProjects,
            'inactiveStudents' => $inactiveStudents, 'po' => $po,
            'pendingProjects' => $pendingProjects, 'spaceUsers' => $spaceUsers,
            'publishedProjects' => $publishedProjects,
            'approvedProjects' => $approvedProjects,
            'closedProjects' => $closedProjects,
            'deniedProjects' => $deniedProjects
        ]);
    }
    
}
