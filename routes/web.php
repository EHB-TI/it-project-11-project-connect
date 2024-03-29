<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProjectDetailsController;
use App\Http\Controllers\ReviewController;
use App\Models\NotificationUserStatus;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeadlineController;
use App\Http\Controllers\SpaceController;

use Illuminate\Http\Request;
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

// SPACE ROUTES
// display a list of spaces
Route::get('/spaces', [SpaceController::class,'index'])->name('spaces.index')->middleware('auth');

// show the form to create a new space
Route::get('/spaces/create', [SpaceController::class,'create'])->name('spaces.create')->middleware('role:teacher', 'auth');

//store a new space
Route::post('/spaces', [SpaceController::class,'store'])->name('spaces.store')->middleware('role:teacher', 'auth');

Route::post('/spaces/select', [SpaceController::class, 'select'])->name('spaces.select')->middleware('auth');



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
    Route::get('/login/{id}', function($id) {
        // Find the user by id
        $user = User::find($id);

        // If the user is not found, redirect to the home page
        if (!$user) {
            return redirect('/')->with('status', 'User not found with id: ' . $id);
        }

        // Log the user in
        Auth::login($user, true);

        // Redirect the user to their intended page
        return redirect()->intended();
    });

    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
}

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

//AUTH PROTECTED ROUTES
//only authenticated users can access these routes
Route::middleware(['auth','set.current.space', 'store.route'])->group(function () {

    Route::post('/change-space', function (Request $request) {
        if (session('current_space_id') != $request->input('space_id')) {
            session(['current_space_id' => $request->input('space_id')]);
        }

        $notificationStatus = NotificationUserStatus::where('notification_id', $request->input('notification_id'))
            ->where('user_id', Auth::user()->id)
            ->firstOrFail();

        $notificationStatus->seen = true;
        $notificationStatus->save();
        return redirect($request->input('route'));
    })->name('space.change');

    //DASHBOARD ROUTES
    //display the dashboard for students
    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');


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

    // publish all route for teachers
    Route::post('/projects/publishAll', [ProjectController::class, 'publishAll'])->name('projects.publishAll')->middleware('role:teacher');

    Route::post('/projects/{project}/approve', [ProjectController::class, 'approve'])->name('projects.approve') ->middleware('role:teacher');
    Route::post('/projects/{project}/reject', [ProjectController::class, 'reject'])->name('projects.reject') ->middleware('role:teacher');


    //get the edit component of the project details
    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit')->middleware('checkProjectOwner');

    //update the project details
    Route::post('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');

    // get the discussion between teachers
    Route::get('/projects/details/discussion/{id}', [ProjectDetailsController::class, 'discussion'])->name('projects.discussion')->middleware('role:teacher');
    //update the discussionboard for teachers
    Route::post('/projects/{project}/discussions', [App\Http\Controllers\DiscussionController::class, 'store'])->name('discussions.store')->middleware('role:teacher');
    //store a new review
    Route::post('/projects/{id}/review/{status}', [ProjectController::class, 'review'])->name('projects.review')->middleware('role:teacher');


    //APPLICATION ROUTES
    //display the page of a specific application
    Route::get('/applications', [ApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/create/{project_id}', [ApplicationController::class, 'create'])->name('applications.create');
    Route::post('/applications/{project_id}', [ApplicationController::class, 'store'])->name('applications.store');
    // bekijk daadwerkelijke content of application:
    Route::get('applications/{user_id}', [ApplicationController::class, 'show'])->name('applications.show');

    Route::post('/applications/approve/{id}', [ApplicationController::class, 'approve'])->name('applications.approve');
    Route::post('/applications/reject/{id}', [ApplicationController::class, 'reject'])->name('applications.reject');




    // DEADLINE ROUTES
    // display a list of deadlines
    Route::get('/deadlines', [DeadlineController::class, 'index'])->name('deadlines.index')->middleware('role:teacher');

    // show the form to create a new deadline
    Route::get('/deadlines/create', [DeadlineController::class, 'create'])->name('deadlines.create')->middleware('role:teacher');

    //store a new deadline
    Route::post('/deadlines', [DeadlineController::class, 'store'])->name('deadlines.store')->middleware('role:teacher');


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


