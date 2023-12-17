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
})->name('welcome');


//AUTH ROUTES
//Authentication for production
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
})->name('login');


Route::get('/logout', function() {
    if (app()->environment('local')) {
        // Log the user out of the Laravel application
        Auth::logout();
    } else {
        // Log the user out of the Laravel application
        Auth::logout();
        // Log the user out of the CAS server
        cas()->logout();
    }

    return redirect('/');
})->name('logout');


//Mock authentication for development
//This route is only available in the local environment
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

        //user info should be updated

        // Log the user in
        Auth::login($user, true);

        // Redirect the user to their intended page
        return redirect()->intended();
    });
}

//AUTH PROTECTED ROUTES
//only authenticated users can access these routes
Route::middleware(['auth'])->group(function () {
    //DASHBOARD ROUTES
    //display the dashboard for students
    Route::get('/dashboard', [UserController::class, 'findMyProjectsAndApplications'])->name('dashboard.student')->middleware('role:student');

    //display the dashboard for docents
    Route::get('/docentboard', [UserController::class, 'findProjectsAndApplications'])->name('dashboard.teacher')->middleware('role:teacher');


    //PROJECT ROUTES
    //display a list of projects
    Route::get('/projects', [ProjectController::class, 'findAllProjectsPublished'])->name('approvedProject'); // projects.approve

    //display the page to create a new project
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

    //store a new project
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');


    //PROJECT DETAILS ROUTES
    //display the project details
    Route::get('/project/details/{id}', [ProjectController::class, 'show'])->name('project.details');

    //get the overview component of the project details
    Route::get('/project/details/overview/{id}', [ProjectDetailsController::class, 'showOverview']);

    //get the feedback component of the project details
    Route::get('/project/details/feedback/{id}', [ProjectDetailsController::class, 'showFeedback']);

    //get the members component of the project details
    Route::get('/project/details/members/{id}', [ProjectDetailsController::class, 'showMembers']);

    //get the applications component of the project details
    Route::get('/project/details/applications/{id}', [ProjectDetailsController::class, 'showApplications']);


    //APPLICATION ROUTES
    //display the page of a specific application
    Route::get('/applications', [ApplicationController::class, 'index'])->name('application.index');
    Route::get('/applicationpage', 'App\Http\Controllers\ApplicationController@show');
    Route::post('/applicationpage', 'App\Http\Controllers\ApplicationController@store');


    // DEADLINE ROUTES
    // display a list of deadlines
    Route::get('/deadlines', [DeadlineController::class, 'index'])->name('deadlines.index')->middleware('role:teacher');

    // show the form to create a new deadline
    Route::get('/deadlines/create', [DeadlineController::class, 'create'])->name('deadlines.create')->middleware('role:teacher');

    //store a new deadline
    Route::post('/deadlines', [DeadlineController::class, 'store'])->name('deadlines.store')->middleware('role:teacher');

    // DEADLINE ROUTES
    // display a list of deadlines
    Route::get('/deadlines', [DeadlineController::class, 'index'])->name('deadlines.index')->middleware('role:teacher');
    // show the form to create a new deadline
    Route::get('/deadlines/create', [DeadlineController::class, 'create'])->name('deadlines.create')->middleware('role:teacher');
    //store a new deadline
    Route::post('/deadlines', [DeadlineController::class, 'store'])->name('deadlines.store')->middleware('role:teacher');


    // SPACE ROUTES
    // display a list of spaces
    Route::get('/space', [SpaceController::class,'index'])->name('space.index');

    // show the form to create a new space
    Route::get('/space/create', function () {
        return view('shared.space_create');
    })->name('space.create')->middleware('role:teacher');

    //store a new space
    Route::post('/space/create', [SpaceController::class,'store'])->name('space.create')->middleware('role:teacher');


    //STUDENTS OVERVIEW ROUTES
    //display  page of students
    Route::get('studentsOverview',[UserController::class,'index'])->name('studentsOverview');

    //USER INFORMATION ROUTES
    Route::get('/user/{id}', [UserController::class,'show'])->name('userInformation');
    //
});



