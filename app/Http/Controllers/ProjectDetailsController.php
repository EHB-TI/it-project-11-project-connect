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
        //$projectFeedback = find project feedback by id

        return view('projects.detail-sections.feedback', ['project_id' => $id]);
    }

    public function members($id)
    {
        //$projectMembers = find project members by id

        return view('projects.detail-sections.members', ['project_id' => $id]);
    }

    public function applications($id)
    {
        //$projectApplications = find project applications by id

        return view('projects.detail-sections.applications',  ['project_id' => $id]);
    }
}
