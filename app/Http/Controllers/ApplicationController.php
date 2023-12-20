<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Application;

use App\Models\Deadline;

use App\Models\Space;

use Auth;




class ApplicationController extends Controller
{
    function show(Request $request)
    {
        $application = Application::find($request->id);
        return view('applications.show', ['application' => $application]);
    }


    public function store(Request $request, string $project_id)
    {
        $space_id = session('current_space_id');
        // Find the deadline for applying to projects in the current space
        $deadline = Space::findOrFail($space_id)
            ->deadlines()
            ->where('title', 'Apply For Projects')
            ->first();
    
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
    
        // Check if either a file or a motivation is provided
        if (!$request->hasFile('file') && !$request->has('motivation')) {
            return redirect()->back()->with('status', 'Please upload a file or write a motivation.');
        }
    
        // Initialize filePath variable
        $filePath = null;
    
        // Check if a file is provided and store it
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

    public function approve(Request $request)
    {
        $application = Application::find($request->id);
        $application->status = 'approved';
        $application->user->applications()->where('status', 'pending')->update(['status' => 'rejected']);
        $application->save();

        $application->project->users()->attach($application->user->id);

        return redirect()->route('applications.index')->with('status', 'Application Approved!');
    }

    public function reject(Request $request)
    {
        $application = Application::find($request->id);
        $application->status = 'rejected';
        $application->save();
        return redirect()->route('applications.index')->with('status', 'Application Rejected!');
    }
}
