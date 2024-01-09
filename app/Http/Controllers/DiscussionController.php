<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Discussion;
use App\Models\Project;

class DiscussionController extends Controller
{
    public function store (Request $request, $id){
        $request->validate([
            'message' => 'required'
        ]);

        $discussion = new Discussion();
        $discussion->message = $request->input('message');
        $discussion->user_id = auth()->id();
        $discussion->project_id = $id;
        $discussion->save();
        
        return redirect()->route('projects.show', $id)->with('status', 'Discussion successfully send');
    }

    public function destroy(Discussion $discussion)
    {
        $discussion->delete();
        return redirect()->route('projects.show', $discussion->project_id);
    }

    public function findByProject(Project $project)
    {
        return Discussion::where('project_id', $project->id)->get();
    }
}
