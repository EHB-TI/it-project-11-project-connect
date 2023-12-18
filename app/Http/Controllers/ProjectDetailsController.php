<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectDetailsController extends Controller
{
    public function overview($id)
    {
        $project = Project::find($id);

        if ($project === null) {
            // Redirect back or show an error message
            return redirect('/')->with('error', 'Project not found');
        }

        return view('projects.detail-sections.overview', ['project' => $project]);
    }

    public function feedback($id)
    {
        $project = Project::find($id);
        $projectFeedback = $project->feedback()->orderBy('created_at', 'desc')->get();

        return view('projects.detail-sections.feedback', ['project' => $project, 'projectFeedback' => $projectFeedback]);
    }

    public function members($id)
    {
        $project = Project::find($id);
        $projectMembers = $project->users;

        return view('projects.detail-sections.members', ['project' => $project, 'projectMembers' => $projectMembers]);
    }

    public function applications($id)
    {
        $project = Project::find($id);
        $projectApplications = $project->applications;

        return view('projects.detail-sections.applications',  ['project' => $project, 'projectApplications' => $projectApplications]);
    }
}
