<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
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



Route::get('/', [SpaceController::class, 'index'])->name('welcome');


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

    Route::middleware(['set.current.space'])->group(function () {
        Route::get('/dashboard/{space_id}', [DashboardController::class, 'show'])->name('dashboard');
    });




    //PROJECT ROUTES
    //display a list of projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

    //display the page to create a new project
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

    //store a new project
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    //publish route for teachers
    Route::post('/projects/publish', [ProjectController::class, 'publish'])->name('projects.publish')->middleware('role:teacher');
    //unpublish route for teachers
    Route::post('/projects/{project}/unpublish', [ProjectController::class, 'unpublish'])->name('projects.unpublish') ->middleware('role:teacher');

    
    //PROJECT DETAILS ROUTES
    //display the project details
    Route::get('/projects/details/{id}', [ProjectController::class, 'show'])->name('projects.show');

    //get the overview component of the project details
    Route::get('/projects/details/overview/{id}', [ProjectDetailsController::class, 'overview']);

    //get the feedback component of the project details
    Route::get('/projects/details/feedback/{id}', [ProjectDetailsController::class, 'feedback']);

    //get the members component of the project details
    Route::get('/projects/details/members/{id}', [ProjectDetailsController::class, 'members']);

    //get the applications component of the project details
    Route::get('/projects/details/applications/{id}', [ProjectDetailsController::class, 'applications']);

    //get the edit component of the project details
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit']) ->name('projects.edit')->middleware('checkProjectOwner');

    //update the project details
    Route::post('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');

    //APPLICATION ROUTES
    //display the page of a specific application
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create/{project_id}', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications/{project_id}', [ApplicationController::class, 'store'])->name('applications.store');


    // DEADLINE ROUTES
    // display a list of deadlines
    Route::get('/deadlines', [DeadlineController::class, 'index'])->name('deadlines.index')->middleware('role:teacher');

    // show the form to create a new deadline
    Route::get('/deadlines/create', [DeadlineController::class, 'create'])->name('deadlines.create')->middleware('role:teacher');

    //store a new deadline
    Route::post('/deadlines', [DeadlineController::class, 'store'])->name('deadlines.store')->middleware('role:teacher');


    // SPACE ROUTES
    // display a list of spaces
    Route::get('/spaces', [SpaceController::class,'index'])->name('spaces.index');

    // show the form to create a new space
    Route::get('/spaces/create', [SpaceController::class,'create'])->name('spaces.create')->middleware('role:teacher');

    //store a new space
    Route::post('/spaces', [SpaceController::class,'store'])->name('spaces.store')->middleware('role:teacher');


    //STUDENTS OVERVIEW ROUTES
    //display  page of students
    Route::get('/students',[UserController::class,'index'])->name('students.index');

    //STUDENT INFORMATION ROUTES
    Route::get('/students/{id}', [UserController::class,'show'])->name('students.show');
    //


    //FEEDBACK ROUTES
    //store a new feedback
    Route::post('/feedback/{id}', [FeedbackController::class, 'store'])->name('feedback.store');

});


Route::middleware(['store.route'])->group(function () 
// ->group(function () 
{
//display the dashboard for students
// Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');


//PROJECT ROUTES
//display a list of projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

//display the page to create a new project
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

//store a new project
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');


//PROJECT DETAILS ROUTES
//display the project details
Route::get('/projects/details/{id}', [ProjectController::class, 'show'])->name('projects.show');

//get the overview component of the project details
Route::get('/projects/details/overview/{id}', [ProjectDetailsController::class, 'overview']);

//get the feedback component of the project details
Route::get('/projects/details/feedback/{id}', [ProjectDetailsController::class, 'feedback']);

//get the members component of the project details
Route::get('/projects/details/members/{id}', [ProjectDetailsController::class, 'members']);

//get the applications component of the project details
Route::get('/projects/details/applications/{id}', [ProjectDetailsController::class, 'applications']);


//APPLICATION ROUTES
//display the page of a specific application
Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
Route::get('/applications/create/{project_id}', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('/applications/{project_id}', [ApplicationController::class, 'store'])->name('applications.store');


// DEADLINE ROUTES
// display a list of deadlines
Route::get('/deadlines', [DeadlineController::class, 'index'])->name('deadlines.index')->middleware('role:teacher');

// show the form to create a new deadline
Route::get('/deadlines/create', [DeadlineController::class, 'create'])->name('deadlines.create')->middleware('role:teacher');

//store a new deadline
Route::post('/deadlines', [DeadlineController::class, 'store'])->name('deadlines.store')->middleware('role:teacher');


// SPACE ROUTES
// display a list of spaces
Route::get('/spaces', [SpaceController::class,'index'])->name('spaces.index');

// show the form to create a new space
Route::get('/spaces/create', [SpaceController::class,'create'])->name('spaces.create')->middleware('role:teacher');

//store a new space
Route::post('/spaces', [SpaceController::class,'store'])->name('spaces.store')->middleware('role:teacher');


//STUDENTS OVERVIEW ROUTES
//display  page of students
Route::get('/students',[UserController::class,'index'])->name('students.index');

//STUDENT INFORMATION ROUTES
Route::get('/students/{id}', [UserController::class,'show'])->name('students.show');
//


//FEEDBACK ROUTES
//store a new feedback
Route::post('/feedback/{id}', [FeedbackController::class, 'store'])->name('feedback.store');
});


