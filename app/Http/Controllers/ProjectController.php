<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->id();
        return view('projects.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Title' => 'required|max:100', // Assuming the input field name is 'Title'
            'content' => 'required', // Assuming the input field name is 'content'
            'user' => 'required|numeric', // Assuming the input field name is 'user'
        ]);

        // Create a new project instance
        $project = new Project();
        $project->name = $validatedData['Title'];
        $project->description = $request->input('content');
        $project->owner_id = $validatedData['user']; // Assuming 'user' corresponds to owner_id

        // Save the project to the database
        $project->save();

        // Optionally, you can redirect to a specific route after storing the project
        return redirect()->route('projects.show', ['project' => $project])->with('status', 'Project Created!');
    }

    /**
     * Display the specified resource.
     */
    public function show($Id) {
        $project = Project::find($Id);
        if ($project === null) {
            // Redirect back or show an error message
            return redirect('project.index')->with('error', 'Project not found');
        } else {
            return view('projects.show', ['project' => $project]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }


}
