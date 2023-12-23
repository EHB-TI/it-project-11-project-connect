<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

use App\Models\Deadline;

use App\Models\Notification;
use App\Models\User;

use App\Models\Space;

use Auth;




class ApplicationController extends Controller
{
    function show($id)
    {
        $application = Application::find($id);
        if (!$application) {
            return redirect()->back()->with('error', 'Application not found.');
        }

        return view('applications.show', compact('application'));
    }


    public function store(Request $request, string $project_id)
    {
        $space_id = session('current_space_id');
        // Find the deadline for applying to projects in the current space


        $space = Space::find($space_id);
        $deadline = $space->deadlines()->get()->where('what', 'Apply For Projects')->first();

        // Check if the deadline is not found or has expired
        if (!$deadline || strtotime($deadline->end_date) < strtotime(now())) {
            return back()->with('status', 'You cannot apply for a project at this time.');
        }

        // Find the project
        $project = Project::findOrFail($project_id);

        // Check if the user can apply for the project
        if (!$project->canApply(Auth::user())) {
            return redirect(route('projects.show', $project_id))->with('status', 'You cannot apply for this project.');
        }


        $request->validate([
            'motivation' => 'required_without:file',
            'file' => 'required_without:motivation|mimes:pdf,doc,docx,txts',
        ]);


        // get path of file, store it
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('public');
        }

        // Create a new application
        $application = new Application();
        $application->file_path = $filePath;
        $application->motivation = $request->input('motivation');
        $application->user_id = Auth::user()->id;
        $application->project_id = $project_id;
        $application->save();

        $space = Space::find(session('current_space_id'));

        $notification = Notification::create([
            'content' => $space->name . ': ' . Auth::user()->name . ' has applied for your project: ' . $project->name,
            'route' => route('applications.show', $application->id),
            'space_id' => session('current_space_id'),
        ]);

        $user = User::find($project->user_id);

        $user->notifications()->attach($notification->id, ['seen' => false]);


        // Redirect with success message
        return redirect(route('projects.show', $project_id))->with('status', 'Application submitted successfully.');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $applications = Application::with('user')->get();
        $currentSpaceId = session('current_space_id');

        $applications = Application::with('user', 'project.space')
            ->whereHas('project', function ($query) use ($currentSpaceId) {
                $query->where('space_id', $currentSpaceId);
            })
            ->get();


        // Return the applications with user names to a view or as needed
        return view('applications.teacher.index', ['applications' => $applications]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($project_id)
    {
        $project = Project::find($project_id);
        return view('applications.student.create', ['project' => $project]);
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve($id)
    {
        $application = Application::find($id);
        if($application->status == 'approved'){
            return redirect()->route('projects.show', $application->project->id)->with('status', 'Application Already Approved!');
        }
        $application->status = 'approved';
        $application->user->applications()->where('status', 'pending')->update(['status' => 'rejected']);
        $application->save();

        $application->project->users()->attach($application->user->id);

        $space_name = Space::find(session('current_space_id'))->name;

        $project = Project::find($application->project->id);

        $notification = Notification::create([
            'content' => $space_name . ': ' . Auth::user()->name . ' has approved your application for: ' . $project->title,
            'route' => route('project.show', $project->id),
            'space_id' => session('current_space_id'),
        ]);

        $user = User::find($application->user_id);

        $user->notifications()->attach($notification->id, ['seen' => false]);

        return redirect()->route('projects.show', $application->project->id)->with('status', 'Application Approved!');
    }

    public function reject($id)
    {
        $application = Application::find($id);
        if($application->status == 'rejected'){
            return redirect()->route('projects.show', $application->project->id)->with('status', 'Application Already Rejected!');
        }
        $application->status = 'rejected';
        $application->save();

        $space_name = Space::find(session('current_space_id'))->name;

        $project = Project::find($application->project->id);

        $notification = Notification::create([
            'content' => $space_name . ': ' . Auth::user()->name . ' has rejected your application for: ' . $project->title,
            'route' => route('application.show', $application->id),
            'space_id' => session('current_space_id'),
        ]);

        $user = User::find($application->user_id);

        $user->notifications()->attach($notification->id, ['seen' => false]);

        return redirect()->route('projects.show', $application->project->id)->with('status', 'Application Rejected!');
    }
}
