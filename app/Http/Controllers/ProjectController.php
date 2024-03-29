<?php

namespace App\Http\Controllers;

use App\Http\Middleware\StoreRoute;
use App\Models\Project;
use App\Models\Review;
use App\Models\User;
use App\Models\Space;
use App\Models\Notification;
use App\Models\Deadline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Auth;
use Closure;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $space_id = session('current_space_id');
        $space = Space::find($space_id);
        //authenticatie teacher for all projects
        if (Auth::user()->role == 'teacher'){
            $projects = Space::find($space_id)->projects()->get();
        } else {
            $projects = Space::find($space_id)->projects()->where('status', 'published')->get();
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

        $previousRoute = $this->storeRoute();

        return view('projects.show', ['project' => $project, 'previousRoute' => $previousRoute]);
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
        $space_id = session('current_space_id');

        $deadline = Space::findOrFail($space_id)
        ->deadlines()
        ->where('what', 'Create Project')
        ->first();

        if ($user->hasRole('student') && (($deadline !== null && strtotime($deadline->end_date) < strtotime(now())) || $deadline === null)) {
            return back()->with('status', 'You cannot create a project at this time.');
        }

        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
        ]);

        $filePath = '';
        // get path of file, store it
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->storePublicly('public');
            $filePath = str_replace('public/', '', $filePath);
        }

        // Create a new project instance
        $project = new Project();
        $project->name = $validatedData['name'];
        $project->brief = $request->input('brief');
        $project->description = $request->input('description');
        $project->file_path = $filePath;
        $project->user_id = $user->id;
        $project->space_id = session('current_space_id');

        if ($user->hasRole('teacher')) {
            $project->status = 'approved';
        }

        // Save the project to the database
        $project->save();

        // Attach the authenticated user to the project
        $project->users()->attach($user->id);
        $user->save();


        // Optionally, you can redirect to a specific route after storing the project
        return redirect()->route('projects.show', $project->id)->with('status', 'Project Created!');
    }


    public function publish(Request $request)
    {
        $project = Project::find($request->project_id);
        if ($project) {
            $project->status = 'published';
            $project->save();
        }

        $space_name = Space::find(session('current_space_id'))->name;

        $notification = Notification::create([
            'content' => $space_name . ': ' . 'Your Project has been published: ' . $project->name,
            'route' => route('projects.show', $project->id),
            'space_id' => session('current_space_id'),
        ]);

        $user = User::find($project->user_id);

        $user->notifications()->attach($notification->id, ['seen' => false]);

        return back()->with('status', 'Project Published!');
    }

    public function unpublish(Request $request, Project $project)
    {
        $project->status  = 'pending';
        $project->save();

        return back()->with('status', 'Project Unpublished!');
    }

    public function publishAll(Request $request)
    {
        $space_id = session('current_space_id');
        $space_name = Space::find($space_id)->name;
    
        // Check if there are approved projects
        $approvedProjects = Space::find($space_id)->projects()->where('status', 'approved')->get();
    
        if ($approvedProjects->isEmpty()) {
            return back()->with('status', 'No projects to publish.');
        }
    
        // Publish all approved projects
        foreach ($approvedProjects as $project) {
            $project->status = 'published';
            $project->save();
    
            $notification = Notification::create([
                'content' => $space_name . ': ' . 'Your Project has been published: ' . $project->name,
                'route' => route('projects.show', $project->id),
                'space_id' => session('current_space_id'),
            ]);
    
            $user = User::find($project->user_id);
    
            $user->notifications()->attach($notification->id, ['seen' => false]);
        }
    
        return back()->with('status', 'All Projects Published!');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $project = Project::find($id);


        // Controleer of de gebruiker de eigenaar van het project is
        if (Auth::user()->id !== $project->user_id) {
            return redirect()->route('projects.show', ['id' => $id])->with('error', 'You are not the owner of this project.');
        }

        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

         //valideren van de date
         $request -> validate([
            'name'=>'required',
            'brief'=>'required',
            'description'=>'required',
         ]);

        //check if the user is the owner of the project
        if (Auth::user()->id !== $project->user_id) {
            return redirect('/projects')->with('error', 'You are not the product-Owner');
        }

        //update the project
        $project->name = $request->name;
        $project->brief = $request->brief;
        $project->description = $request->description;
        $project->save();

        return redirect()->route('projects.show', $project->id)->with('status', 'Project Updated!');
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


    public function storeRoute()
    {
        $request = request();
        $routes = Route::getRoutes();

        $referrer = $request->header('referer');
        $referrer = str_replace("http://localhost:8000/", '', $referrer);
        foreach ($routes as $route) {
            if ($referrer === $route->uri()) {
                // If it matches, retrieve the route name and return it
                $routeName = $route->getName();
                return $routeName;
            }
        }
    }

    public function review(Request $request, $id, $status)
    {
        // Convert the status parameter to a boolean value
        $status = $status === 'approve';

        // Fetch the existing review for the project and user
        $review = Review::where('project_id', $id)->where('user_id', Auth::user()->id)->first();

        // If a review exists, update its status. If not, create a new review.
        if ($review) {
            $review->status = $status;
        } else {
            $review = new Review([
                'status' => $status,
                'project_id' => $id,
                'user_id' => Auth::user()->id,
            ]);
        }

        // Save the review to the database
        $review->save();

        return back()->with('status', 'Review submitted successfully!');
    }

    public function approve(Project $project)
    {
        $project->status = 'approved';
        $project->save();

        return back()->with('status', 'Project Approved!');

    }

    public function reject(Project $project)
    {
        $project->status = 'denied';
        $project->save();

        return back()->with('status', 'Project Rejected!');
    }

}


