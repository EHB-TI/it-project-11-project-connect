<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class ApplicationController extends Controller
{
 function Show(Request $request)
 {
    return view('students.applicationpage');
 }

 
 public function store(Request $request)
 {
     // Validate the incoming request
      $validatedData = $request->validate([
         'fileurl' => 'required_without:motivationContent|file',
         'motivationContent' => 'required_without:fileurl|string',
      ]);


     // get path of file, store it
     if ($request->hasFile('fileurl')) {
         $filePath = $request->file('fileurl')->store('applications', 'public');
     }

     $application = new Application();
     $application->fileurl = $filePath ?? null;
     $application->motivationContent = $validatedData['motivationContent'];
     $application->applicantID = 1; //Auth::id(); // Assuming you're using Laravel's authentication
     $application->save();

     // Redirect or return response
     return redirect()->back()->with('success', 'Application submitted successfully.');
 }
 
}
