<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Http\Request;
use App\Models\Space;
class SpaceController extends Controller
{

    public function index() {
        $spaces = Space::all();
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

        $courseId = $validatedData['canvasCourseId'];
        $users = $space->getCourseUsers($courseId);

        return redirect()->route('spaces.index')->with('success', 'Space created successfully.');
    }


    public function show($id){
    //
    }

    public function create(){
        return view('spaces.teacher.create');
    }

}


