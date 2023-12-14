<?php

use App\Http\Controllers\ProjectDetailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

// Needs to go through project controller (create)
Route::get('/project/create', function() {
    return view('shared.project_proposition');
});

Route::get('/space', function () {
    return view('shared.space');
});



// Needs to go through project controller (create)
Route::get('/project/create', function() {
    return view('shared.project_proposition');
});

Route::get('/project/details/{id}', [ProjectController::class, 'show']);
Route::get('/project/details/overview/{id}', [ProjectDetailsController::class, 'showOverview']);
Route::get('/project/details/feedback/{id}', [ProjectDetailsController::class, 'showFeedback']);
Route::get('/project/details/members/{id}', [ProjectDetailsController::class, 'showMembers']);
Route::get('/project/details/applications/{id}', [ProjectDetailsController::class, 'showApplications']);

