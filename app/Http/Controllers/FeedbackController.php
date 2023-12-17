<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Project;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $feedback = new Feedback();
        $feedback->message = $request->input('message');
        $feedback->user_id = auth()->id();
        $feedback->project_id = $id;
        $feedback->save();

        return redirect()->route('projects.show', $id)->with('status', 'Feedback added successfully');
    }

    public function destroy(Feedback $feedback)
    {
        $feedback->delete();
        return redirect()->route('projects.show', $feedback->project_id);
    }

    public function findByProject(Project $project)
    {
        return Feedback::where('project_id', $project->id)->get();
    }


}
