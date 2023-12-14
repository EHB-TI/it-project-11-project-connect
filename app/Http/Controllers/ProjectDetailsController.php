<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectDetailsController extends Controller
{
    public function showOverview($id)
    {
        $project = \App\Models\Project::find($id);

        if ($project === null) {
            // Redirect back or show an error message
            return redirect('/')->with('error', 'Project not found');
        }

        return view('shared.detail-sections.overview', ['project' => $project]);
    }

    public function showFeedback($id)
    {
        //$projectFeedback = find project feedback by id

        return view('shared.detail-sections.feedback', ['projectId' => $id]);
    }

    public function showMembers($id)
    {
        //$projectMembers = find project members by id

        return view('shared.detail-sections.members', ['projectId' => $id]);
    }

    public function showApplications($id)
    {
        //$projectApplications = find project applications by id

        return view('shared.detail-sections.applications',  ['projectId' => $id]);
    }
}
