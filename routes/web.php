<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SelectionListController;
use App\Http\Controllers\SelectionController;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/project/{id}', [ProjectController::class, 'show']);

    Route::get('/selections', [SelectionListController::class, 'index']);
    Route::get('/selection-list/{id}', [SelectionListController::class, 'show']);

    Route::get('/selection/{id}', [SelectionController::class, 'show']);
});
