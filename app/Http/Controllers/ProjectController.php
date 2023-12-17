<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Auth;

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
     * Display the specified resource.
     */
    public function show($id)
    {
        $project = Project::find($id);

        if ($project === null) {
            // Redirect back or show an error message
            return redirect('/')->with('error', 'Project not found');
        }

        return view('projects.show', ['project' => $project]);
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
            'name' => 'required|max:100',
            'description' => 'required',
        ]);

        // Create a new project instance
        $project = new Project();
        $project->name = $validatedData['name'];
        $project->brief = $request->input('brief');
        $project->description = $request->input('description');
        $project->owner_id = Auth::user()->id;

        // Save the project to the database
        $project->save();

        // Optionally, you can redirect to a specific route after storing the project
        return redirect()->route('projects.show', $project->id)->with('status', 'Project Created!');
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
