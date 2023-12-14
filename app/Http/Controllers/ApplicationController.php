<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;

class ApplicationController extends Controller
{
 function Show(Request $request)
 {
    return view('students.applicationpage');
 }
 
}
