<?php

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
Route::get('/students/approvedProjects', [ProjectController::class, 'findAllProjectsPublished'])->name('approvedProject');

Route::get('/students/makeProject', [ProjectController::class, 'create'])->name('makeProject');
Route::post('/students/makeProject', [ProjectController::class, 'store'])->name('storeProjects');

