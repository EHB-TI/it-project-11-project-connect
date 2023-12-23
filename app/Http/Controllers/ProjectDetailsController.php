<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Space;
use Illuminate\Http\Request;
use Auth;

class ProjectDetailsController extends Controller
{
    public function overview($project_id)
    {

        $space_id = session('current_space_id');
        $project = Space::find($space_id)->projects()->find($project_id);

        if ($project === null) {
            // Redirect back or show an error message
            return redirect('/')->with('error', 'Project not found');
        }

        return view('projects.detail-sections.overview', ['project' => $project]);
    }

    public function feedback($project_id)
    {
        
        $space_id = session('current_space_id');
        $project = Space::find($space_id)->projects()->find($project_id);
        $projectFeedback = $project->feedback()->orderBy('created_at', 'desc')->get();

        return view('projects.detail-sections.feedback', ['project' => $project, 'projectFeedback' => $projectFeedback]);
    }

    public function members($project_id)
    {
        
        $space_id = session('current_space_id');
        $project = Space::find($space_id)->projects()->find($project_id);
        $projectMembers = $project->users;

        return view('projects.detail-sections.members', ['project' => $project, 'projectMembers' => $projectMembers]);
    }

    public function applications($project_id)
    {
        
        $space_id = session('current_space_id');
        $project = Space::find($space_id)->projects()->find($project_id);
        $projectApplications = $project->applications;

        return view('projects.detail-sections.applications',  ['project' => $project, 'projectApplications' => $projectApplications]);
    }

    public function edit($id)
    {
        $project = Project::find($id);
    
        // Controleer of de gebruiker de eigenaar van het project is
        if (Auth::user()->id !== $project->user_id) {
            return redirect() ->route('projects.show',['id' => $id])->with('error', 'You are not the owner of this project.');
        }
    
        return view('projects.detail-sections.edit', compact('project'));
    }


    public function discussion($project_id)
    {
        $space_id = session('current_space_id');
        $project = Space::find($space_id)->projects()->find($project_id);
        $projectDiscussions = $project->discussions()->orderBy('created_at', 'desc')->get();

        return view('projects.detail-sections.discussion', ['project' => $project, 'projectDiscussions' => $projectDiscussions]);
    }
}
