<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Deadline;
use App\Models\Space;

class DeadlineController extends Controller
{
    public function index()
    {
        $space_id = session('current_space_id');
       // $deadlines = Deadline::latest()->get();
        $deadlines = Space::find($space_id)->deadlines()->latest()->get();

        return view('deadlines.teacher.index', compact('deadlines'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string',
            'what' => 'required|string',
            'when_date' => 'required|date',
            'when_time' => 'required|date_format:H:i',
        ]);

        Deadline::create([
            'title' => $validatedData['title'],
            'what' => $validatedData['what'],
            'end_date' => $validatedData['when_date'] . ' ' . $validatedData['when_time'],
            'space_id' => session('current_space_id'),
        ]);

        return redirect()->route('deadlines.index')->with('status', 'Deadline Created!');
    }

    public function create()
    {
        return view('deadlines.teacher.create');
    }
}
