<?php

namespace App\Http\Controllers;


use Exception;
use Illuminate\Http\Request;
use App\Models\Space;
class SpaceController extends Controller
{

    public function index(){
        $spaces = Space::all();
        return view('shared.space', compact('spaces'));
    }

    public function store(Request $request){
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'space_id' => 'required|unique:spaces',
        'course' => 'required',
        'default_teamsize' => 'required|integer',
    ]);
    $space = new Space;
    $space->name = $validatedData['name'];
    $space->space_id = $validatedData['space_id'];
    $space->course = $validatedData['course'];
    $space->default_teamsize = $validatedData['default_teamsize'];
    $space->save();

    if ($space->save()) {
        return redirect('/space')->with('success', 'Space created successfully.');
    } else {
        throw new Exception('Failed to create space.');
    }
    }

    public function show($id){
    //
    }

    public function create(){
        return view('spaces.create');
    }

}


