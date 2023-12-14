<?php

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
Route::get('/students/approvedProjects', [ProjectController::class, 'findAllProjectsPublished'])->name('approvedProject');
//ROUTE TO PAGE TO CREATE A PROJECT
Route::get('/students/makeProject', [ProjectController::class, 'create'])->name('makeProject');
Route::post('/students/makeProject', [ProjectController::class, 'store'])->name('storeProjects');
//ROUTE TO DASHBOARD STUDENTS
Route::get('/students/dashboard', [UserController::class, 'findMyProjectsAndApplications'])->name('dashboard');

// Needs to go through project controller (create)
Route::get('/project/create', function() {
    return view('shared.project_proposition');
});

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

Route::get('/project/details/{id}', [ProjectController::class, 'show']);
Route::get('/project/details/overview/{id}', [ProjectDetailsController::class, 'showOverview']);
Route::get('/project/details/feedback/{id}', [ProjectDetailsController::class, 'showFeedback']);
Route::get('/project/details/members/{id}', [ProjectDetailsController::class, 'showMembers']);
Route::get('/project/details/applications/{id}', [ProjectDetailsController::class, 'showApplications']);

