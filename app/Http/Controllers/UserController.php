<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Application;
use App\Models\User;
use App\Models\Space;
use Auth;



class UserController extends Controller
{

    public function index(){
        $users = User::where('role', 'student')->get();
        return view('students.index', ['users' => $users]);
    }


    public function show($id){
        $user = User::find($id);
        $application = Application::find($user->id);

        return view('students.show', ['user' => $user, 'application' => $application]);

    }

    public function create()
    {
        if (app()->environment('local') || app()->environment('testing') || app()->environment('staging')) {
            return view('createUser');
        }
    }

    public function store(Request $request)
    {
        if (app()->environment('local') || app()->environment('testing') || app()->environment('staging')) {
            $user = User::create([
                'name' => $request->name,
                'role' => $request->role,
                'available' => $request->has('available'),
                'access_card_id' => $request->access_card_id,
            ]);
            Auth::login($user, true);
            return redirect()->intended();
        }

        return redirect()->route('welcome');
    }
}
