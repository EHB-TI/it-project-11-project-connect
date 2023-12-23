<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Space;
use App\Models\Notification;
use App\Models\User;

use Auth;

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

        $space_name = Space::find(session('current_space_id'))->name;

        $project = Project::find($id);	


        $notification = Notification::create([
            'content' => $space_name . ': ' . Auth::user()->name . ' has left feedback for: ' . $project->name,
            'route' => route('projects.show', $id),
            'space_id' => session('current_space_id'),
        ]);

        $user = User::find($project->user_id);

        $user->notifications()->attach($notification->id, ['seen' => false]);
        
        return redirect()->route('projects.show', $id)->with('status', 'Feedback successfully sent');
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
