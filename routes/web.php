<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProjectDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeadlineController;
use App\Http\Controllers\SpaceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//ROUTE TO APPROVEDPROJECT PAGE
Route::get('/projects', [ProjectController::class, 'findAllProjectsPublished'])->name('approvedProject'); // projects.approve
//ROUTE TO PAGE TO CREATE A PROJECT
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
//ROUTE TO DASHBOARD STUDENTS
Route::get('/dashboard', [UserController::class, 'findMyProjectsAndApplications'])->name('dashboard');

//ROUTE TO DASHBOARD TEACHERS
Route::get('/docentboard', [UserController::class, 'findProjectsAndApplications'])->name('dashboard');


//INCOMING APPLICATION 
Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');


// DEADLINE ROUTES
// display a list of deadlines
Route::get('/deadlines', [DeadlineController::class, 'index'])->name('deadlines.index');
// show the form to create a new deadline
Route::get('/deadlines/create', [DeadlineController::class, 'create'])->name('deadlines.create');
//store a new deadline
Route::post('/deadlines', [DeadlineController::class, 'store'])->name('deadlines.store');

// SPACE ROUTES
// display a list of spaces
Route::get('/space', [SpaceController::class,'index'])->name('space.index');
// show the form to create a new space
Route::get('/space/create', function () {
    return view('shared.space_create');
})->name('space.create');
//store a new space
Route::post('/space/create', [SpaceController::class,'store'])->name('space.create');

// Needs to go through project controller (create)
Route::get('/project/create', function() {
    return view('shared.project_proposition');
});

Route::get('/project/details/{id}', [ProjectController::class, 'show'])->name('project.details');
Route::get('/project/details/overview/{id}', [ProjectDetailsController::class, 'showOverview']);
Route::get('/project/details/feedback/{id}', [ProjectDetailsController::class, 'showFeedback']);
Route::get('/project/details/members/{id}', [ProjectDetailsController::class, 'showMembers']);
Route::get('/project/details/applications/{id}', [ProjectDetailsController::class, 'showApplications']);

