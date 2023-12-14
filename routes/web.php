<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DeadlineController;

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


// DEADLINE ROUTES
// display a list of deadlines
Route::get('/deadlines', [DeadlineController::class, 'index'])->name('deadlines.index');
// show the form to create a new deadline
Route::get('/deadlines/create', [DeadlineController::class, 'create'])->name('deadlines.create');
//store a new deadline
Route::post('/deadlines', [DeadlineController::class, 'store'])->name('deadlines.store');

Route::get('/space', function () {
    return view('shared.space');
}) -> name('space');

// Needs to go through space controller (create)
Route::get('/space/create', function () {
    return view('shared.space_create');
})->name('spaces.create');

Route::get('/space', 'App\Http\Controllers\SpaceController@index');

Route::post('/space', 'App\Http\Controllers\SpaceController@store')->name('space.store');

// Needs to go through project controller (create)
Route::get('/project/create', function() {
    return view('shared.project_proposition');
});
