<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Space;
use App\Models\Deadline;
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
        $space_id = session('current_space_id');
        //authenticatie teacher for all projects
        if (Auth::user()->role == 'teacher'){
            $projects = Space::find($space_id)->projects();
        }else{
            $projects = Space::find($space_id)->projects()->where('status', 'published');
        }
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
        $user = Auth::user();

        $deadline = Deadline::findDeadline('Create Project');

        if ($user->hasRole('student') && (($deadline !== null && strtotime($deadline->end_date) < strtotime(now())) || $deadline === null)) {
            return back()->with('status', 'You cannot create a project at this time.');
        }         

        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
        ]);

        // Create a new project instance
        $project = new Project();
        $project->name = $validatedData['name'];
        $project->brief = $request->input('brief');
        $project->description = $request->input('description');
        $project->user_id = $user->id;
        $project->space_id = session('current_space_id');

        if($user->hasRole('teacher')){
            $project->status = 'approved';
        }

        // Save the project to the database
        $project->save();

        // Attach the authenticated user to the project
        $project->users()->attach($user->id);

        $user->isProductOwner = true;
        $user->save();


        // Optionally, you can redirect to a specific route after storing the project
        return redirect()->route('projects.show', $project->id)->with('status', 'Project Created!');
    }


    public function publish(Request $request){
        $project = Project::find($request->project_id);
        if($project){
            $project->status = 'published';
            $project->save();
        }
       
        return redirect()->route('projects.show', $project->id)->with('status', 'Project Published!');
    }

    public function unpublish(Request $request , Project $project){
        $project->status  = 'denied';
        $project->save();

        return redirect()->route('projects.show', $project->id)->with('status', 'Project Unpublished!');
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

    public function __construct()
    {
        $this->middleware('auth');
    }

}
