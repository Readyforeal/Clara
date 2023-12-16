<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SelectionListController;
use App\Http\Controllers\SelectionController;
use App\Http\Controllers\ItemController;
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

    Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');

    Route::get('/selections', [SelectionListController::class, 'index'])->name('selectionList.index');
    Route::get('/selection-list/{id}', [SelectionListController::class, 'show'])->name('selectionList.show');

    Route::get('/selection/create', [SelectionController::class, 'create'])->name('selection.create');
    Route::post('/selection/create', [SelectionController::class, 'store']);
    Route::get('/selection/{id}', [SelectionController::class, 'show'])->name('selection.show');

    Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
});
