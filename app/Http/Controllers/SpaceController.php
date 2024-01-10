<?php

namespace App\Http\Controllers;


use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Models\Space;
use Auth;
class SpaceController extends Controller
{

    public function index() {
        if (app()->environment('local')) {
            if (Auth::user()) {
                $spaces = Auth::user()->spaces;
            } else {
                $spaces = [];
            }
        } else if (app()->environment('production')){
            if (Auth::user()) {
                $spaces = Auth::user()->spaces;
            } else {
                try {
                    Auth::user()->spaces;
                } catch (Exception $e) {
                    return redirect()->route('login');
                }
            }
        }
        return view('spaces.index', ['spaces' => $spaces]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'canvasCourseId' => 'required',
            'defaultTeamSize' => 'required|integer',
        ]);

        $space = Space::create([
            'name' => $validatedData['name'],
            'canvasCourseId' => $validatedData['canvasCourseId'],
            'defaultTeamSize' => $validatedData['defaultTeamSize'],
        ]);

        // Attach the current authenticated user to the space
        $space->users()->attach(Auth::id());

        $courseId = $validatedData['canvasCourseId'];
        $users = $space->getCourseUsers($courseId);

        foreach ($users as $userData) {
            // Check if a user with the same access card ID already exists
            $user = User::firstOrCreate(
                ['access_card_id' => $userData['access_card_id']],
                ['name' => $userData['name'], 'role' => $userData['role']]
            );

            // Attach the user to the space
            $space->users()->attach($user);
        }

        return redirect()->route('spaces.index')->with('success', 'Space created successfully.');
    }


    public function show($id){
    //
    }

    public function create(){
        return view('spaces.teacher.create');
    }

    public function select(Request $request)
    {
        $request->validate([
            'space_id' => 'required|exists:spaces,id',
        ]);

        session(['current_space_id' => $request->space_id]);

        return redirect()->route('dashboard');
    }

}


