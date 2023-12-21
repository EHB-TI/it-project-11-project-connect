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
        // Fetch space and related data
        $space_id = session('current_space_id');
        $space = Space::find($space_id);
        $spaceUsers = $space->users;
        $projects = $space->projects;
    
        // Fetch deadline
        $deadline = Deadline::nextDeadlineForSpace($space_id);
    
        // Calculate user counts
        $po = $spaceUsers->where('isProductOwner', true)->count();
        $applicants = Application::groupBy('user_id')->count();
        $inactiveStudents = $spaceUsers->count() - $applicants - $po;
    
        // Calculate project counts
        $publishedProjects = $projects->where('status', 'published')->count();
        $approvedProjects = $projects->where('status', 'approved')->count();
        $closedProjects = $projects->where('status', 'closed')->count();
        $deniedProjects = $projects->where('status', 'denied')->count();
        $pendingProjects = $projects->where('status', 'pending')->count();
        $allProjects = $projects->count();
    
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
            'deniedProjects' => $deniedProjects
        ];
    
        // Return the view with the data
        return view('/dashboard', $data);
    }
    
}
