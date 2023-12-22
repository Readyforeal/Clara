<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SelectionListController;
use App\Http\Controllers\SelectionController;
use App\Http\Controllers\ItemController;
use App\Http\COntrollers\ApprovalStageController;
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
    Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
    Route::post('/project/create', [ProjectController::class, 'store']);
    Route::get('/project/{id}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/project/{id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::patch('/project/{id}/edit', [ProjectController::class, 'update']);
    Route::delete('/project/{id}/delete', [ProjectController::class, 'destroy']);

    Route::get('/selections', [SelectionListController::class, 'index'])->name('selectionList.index');
    Route::get('/selection-list/create', [SelectionListController::class, 'create'])->name('selectionList.create');
    Route::post('/selection-list/create', [SelectionListController::class, 'store']);
    Route::get('/selection-list/{id}', [SelectionListController::class, 'show'])->name('selectionList.show');
    Route::get('/selection-list/{id}/edit', [SelectionListController::class, 'edit'])->name('selectionList.edit');
    Route::patch('/selection-list/{id}/edit', [SelectionListController::class, 'update']);
    Route::delete('/selection-list/{id}/delete', [SelectionListController::class, 'destroy']);

    Route::get('/selection/create', [SelectionController::class, 'create'])->name('selection.create');
    Route::post('/selection/create', [SelectionController::class, 'store']);
    Route::get('/selection/{id}', [SelectionController::class, 'show'])->name('selection.show');
    Route::get('/selection/{id}/edit', [SelectionController::class, 'edit'])->name('selection.edit');
    Route::patch('/selection/{id}/edit', [SelectionController::class, 'update']);
    Route::delete('/selection/{id}/delete', [SelectionController::class, 'destroy']);

    Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
    Route::post('/item/create', [ItemController::class, 'store']);
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::patch('/item/{id}/edit', [ItemController::class, 'update']);
    Route::delete('/item/{id}/delete', [ItemController::class, 'destroy']);

    Route::get('/approvals', [ApprovalStageController::class, 'index'])->name('approvalStages.index');
    Route::get('/approval-stage/{id}', [ApprovalStageController::class, 'show'])->name('approvalStage.show');
});
