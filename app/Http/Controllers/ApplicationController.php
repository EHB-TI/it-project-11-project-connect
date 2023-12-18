<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Application;

use Auth;

class ApplicationController extends Controller
{
    function show(Request $request)
    {
        $application = Application::find($request->id);
        return view('applications.teacher.show', ['application' => $application]);
    }


    public function store(Request $request, string $project_id)
    {
        $project = Project::find($project_id);

        if (!$project->canApply(Auth::user())) {
            return redirect(route('projects.show', $project_id))->with('status', 'You cannot apply for this project.');
        }

        if (!$request->hasfile('file') || !$request->has('motivation')) {
            return redirect()->back()->with('status', 'Please upload a file or write a motivation');
        }

        // get path of file, store it
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('public');
        }

        $application = new Application();
        $application->file_path = $filePath ?? null;
        $application->motivation = $request->get('motivation') ?? null;
        $application->user_id = Auth::user()->id;
        $application->project_id = $project_id;
        $application->save();

        // Redirect or return response
        return redirect(route('projects.show', $project_id))->with('status', 'Application submitted successfully.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with('user')->get();

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
}
