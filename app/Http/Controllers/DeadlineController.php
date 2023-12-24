<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Deadline;
use App\Models\Space;
use App\Models\Notification;
use App\Models\User;

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

        $space = Space::find(session('current_space_id'));

        $notification = Notification::create([
            'content' => $space->name . ': a new deadline has been created: ' . $validatedData['what'] . ' on ' . $validatedData['when_date'] . ' at ' . $validatedData['when_time']	,
            'route' => route('dashboard'),
            'space_id' => session('current_space_id'),
        ]);

        $users = User::where('role', 'student')->whereHas('spaces', function ($query) use ($space) {
            $query->where('spaces.id', $space->id);
        })->get();

        foreach ($users as $user) {
            $user->notifications()->attach($notification->id, ['seen' => false]);
        }

        return redirect()->route('deadlines.index')->with('status', 'Deadline Created!');
    }

    public function create()
    {
        return view('deadlines.teacher.create');
    }
}
