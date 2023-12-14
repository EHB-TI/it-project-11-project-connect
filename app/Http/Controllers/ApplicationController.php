<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;

class ApplicationController extends Controller
{
 function Show()
 {
    return view('/public/views/students/applicationpage');
 }
 
}
