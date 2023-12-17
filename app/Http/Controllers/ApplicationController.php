<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

use Auth;

class ApplicationController extends Controller
{
 function show(Request $request)
 {
   // new show page
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
     $application->applicant_id = Auth::user()->id;
     $application->save();

     // Redirect or return response
     return redirect()->back()->with('success', 'Application submitted successfully.');
     
 } 
 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = Application::with('applicant')->get();

        // Return the applications with user names to a view or as needed
        return view('applications.teacher.index', ['applications' => $applications]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('applications.student.create');
    }

    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
