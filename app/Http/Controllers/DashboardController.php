<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Application;
use App\Models\Project;
use App\Models\Deadline;
use App\Models\Space;


class DashboardController extends Controller
{
    public function show(Request $request)
    {
        // Fetch space and related data
        $space_id = session('current_space_id');
        $space = Space::find($space_id);
        $spaceUsers = $space->users;
        $projects = $space->projects;
    
        // Fetch deadline
        $deadline = Deadline::nextDeadlineForSpace($space_id);

        //SELECTING THE PRODUCT OWNERS
        $po = $spaceUsers->where('isProductOwner', true)->count();

        // GET THE APPLICANTS OF THE CORRECT SPACE 
        $projects = Project::where('space_id', $space_id)->get();
        $projectIds = $projects->pluck('id')->toArray();
        $applications = Application::whereIn('project_id', $projectIds)->get();
        $applicants = $applications->groupBy('user_id')->count();

        // Calculate user counts
        $inactiveStudents = $spaceUsers->count() - $applicants - $po;
    
        // Calculate project counts
        $publishedProjects = $projects->where('status', 'published')->count();
        $approvedProjects = $projects->where('status', 'approved')->count();
        $closedProjects = $projects->where('status', 'closed')->count();
        $deniedProjects = $projects->where('status', 'denied')->count();
        $pendingProjects = $projects->where('status', 'pending')->count();
        $allProjects = $projects->count();
    
        //GETTING ALL STUDENTS THAT ARE MEMBERS OF A PROJECT
        // Iterate through each project to count the number of members and sum them up
        $totalMembersCount = [];
        foreach ($projects as $project) {
            $totalMembersCount[$project->name] = $project->users()->count();
        }
        // Data for the view
        $data = [
            'deadline' => $deadline,
            'projects' => $projects,
            'applicants' => $applicants,
            'allProjects' => $allProjects,
            'inactiveStudents' => $inactiveStudents,
            'po' => $po,
            'pendingProjects' => $pendingProjects,
            'spaceUsers' => $spaceUsers,
            'publishedProjects' => $publishedProjects,
            'approvedProjects' => $approvedProjects,
            'closedProjects' => $closedProjects,
            'deniedProjects' => $deniedProjects,
            'members' => $totalMembersCount,
        ];
    
        // Return the view with the data
        return view('/dashboard', $data);
    }
    
}
