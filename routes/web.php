<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProjectDetailsController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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


//Authentication routes

//Authenication for production
Route::get('/login', function() {
    cas()->authenticate();

    $casUser = cas()->user();
    $attributes = cas()->getAttributes();
    $role = $attributes['role'] ?? 'default';
    $access_card_id = $attributes['access_card_id'] ?? '0';

    // Find existing user or create a new user
    $user = User::firstOrCreate(
        ['name' => $casUser],
        ['role' => $role],
        ['available' => 'true'],
        ['access_card_id' => $access_card_id]
    );

    // Log the user in
    Auth::login($user, true);

    // Redirect the user to their intended page
    return redirect()->intended();
});


Route::get('/logout', function() {
    // Log the user out of the Laravel application
    Auth::logout();

    // Log the user out of the CAS server
    if (!app()->environment('local')) {
        cas()->logout();
    }

    return redirect('/');
});


//Mock authentication for development
if (app()->environment('local')) {
    Route::get('/login/{role}', function($role) {
        if (!in_array($role, ['student', 'teacher'])) {
            return redirect('/');
        }

        $casUser = config('cas.cas_attributes.' . $role . '.name');
        $attributes = config('cas.cas_attributes.' . $role . '.attributes');
        $role = $attributes['role'] ?? 'student';

        // Find existing user or create a new user
        $user = User::firstOrCreate(
            ['name' => $casUser],
            ['role' => $role],
            ['available' => 'true'],
            ['access_card_id' => '123456789']
        );

        // Log the user in
        Auth::login($user, true);

        // Redirect the user to their intended page
        return redirect()->intended();
    });
}



//ROUTE TO APPROVEDPROJECT PAGE
Route::get('/projects', [ProjectController::class, 'findAllProjectsPublished'])->name('approvedProject'); // projects.approve
//ROUTE TO PAGE TO CREATE A PROJECT
Route::get('/projects/create', [ProjectController::class, 'create'])->name('makeProject'); // projects.create
Route::post('/projects', [ProjectController::class, 'store'])->name('storeProjects'); // projects.store
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

