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

 // New Store function to handle form submission
 public function store(Request $request)
 {
     // Validate the incoming request
     $validatedData = $request->validate([
         'file' => 'required|file',
         'content' => 'required|string',
     ]);

     // Store the file and get its path
     if ($request->hasFile('file')) {
         $filePath = $request->file('file')->store('applications', 'public');
     }

     // Create a new Application instance and save it
     $application = new Application();
     $application->file = $filePath ?? null;
     $application->content = $validatedData['content'];
     $application->applicantID = Auth::id(); // Assuming you're using Laravel's authentication
     $application->save();

     // Redirect or return response
     return redirect()->back()->with('success', 'Application submitted successfully.');
 }
 
}
