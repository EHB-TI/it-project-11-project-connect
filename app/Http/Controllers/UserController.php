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
}
