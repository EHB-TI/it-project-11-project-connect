<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Deadline;

class DeadlineController extends Controller
{
    public function index()
    {
        $deadlines = Deadline::latest()->get();

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

        // Need space ID from user

        Deadline::create([
            'title' => $validatedData['title'],
            'what' => $validatedData['what'],
            'end_date' => $validatedData['when_date'] . ' ' . $validatedData['when_time'],
            'space_id' => 1,
        ]);

        return redirect()->route('deadlines.index')->with('status', 'Deadline Created!');
    }

    public function create()
    {
        return view('deadlines.teacher.create');
    }
}
