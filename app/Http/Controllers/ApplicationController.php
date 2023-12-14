<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
 function show(Request $request)
 {
    return view('students.applicationpage');
 }

 
 public function store(Request $request)
 {
      
      if(!$request->hasfile('fileurl')&& !$request->has('motivationcontent')){
         return redirect()->back()->with('error','Please upload a file or write a motivation');  
      }

     // get path of file, store it
     if ($request->hasFile('fileurl')) {
         $filePath = $request->file('fileurl')->store('public');
     }

     $application = new Application();
     $application->fileurl = $filePath ?? null;
     $application->motivationContent = $request->get('motivationcontent') ?? null;
     $application->applicantID = 1; //Auth::id();
     $application->save();

     // Redirect or return response
     return redirect()->back()->with('success', 'Application submitted successfully.');
     
 } 
 
}
