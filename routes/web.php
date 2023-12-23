<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SelectionListController;
use App\Http\Controllers\SelectionController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ApprovalStageController;
use App\Http\Controllers\ApprovalController;
use App\Models\ApprovalStage;
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

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/create', [ProjectController::class, 'store']);
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::patch('/projects/{id}/edit', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}/delete', [ProjectController::class, 'destroy']);

    // Selection Lists
    Route::get('/selection-lists', [SelectionListController::class, 'index'])->name('selectionLists.index');
    Route::get('/selection-lists/create', [SelectionListController::class, 'create'])->name('selectionLists.create');
    Route::post('/selection-lists/create', [SelectionListController::class, 'store']);
    Route::get('/selection-lists/{id}', [SelectionListController::class, 'show'])->name('selectionLists.show');
    Route::get('/selection-lists/{id}/edit', [SelectionListController::class, 'edit'])->name('selectionLists.edit');
    Route::patch('/selection-lists/{id}/edit', [SelectionListController::class, 'update']);
    Route::delete('/selection-lists/{id}/delete', [SelectionListController::class, 'destroy']);

    // Selections
    Route::get('/selections/create', [SelectionController::class, 'create'])->name('selections.create');
    Route::post('/selections/create', [SelectionController::class, 'store']);
    Route::get('/selections/{id}', [SelectionController::class, 'show'])->name('selections.show');
    Route::get('/selections/{id}/edit', [SelectionController::class, 'edit'])->name('selections.edit');
    Route::patch('/selections/{id}/edit', [SelectionController::class, 'update']);
    Route::delete('/selections/{id}/delete', [SelectionController::class, 'destroy']);

    // Items
    Route::get('/items/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items/create', [ItemController::class, 'store']);
    Route::get('/items/{id}/edit', [ItemController::class, 'edit'])->name('items.edit');
    Route::patch('/items/{id}/edit', [ItemController::class, 'update']);
    Route::delete('/items/{id}/delete', [ItemController::class, 'destroy']);

    // Approval Stages
    Route::get('/approval-stages', [ApprovalStageController::class, 'index'])->name('approvalStages.index');
    Route::get('/approval-stages/create', [ApprovalStageController::class, 'create'])->name('approvalStages.create');
    Route::post('/approval-stages/create', [ApprovalStageController::class, 'store']);
    Route::get('/approval-stages/{id}', [ApprovalStageController::class, 'show'])->name('approvalStages.show');
    Route::get('/approval-stages/{id}/edit', [ApprovalStageController::class, 'edit'])->name('approvalStages.edit');
    Route::patch('/approval-stages/{id}/edit', [ApprovalStageController::class, 'update']);
    Route::delete('/approval-stages/{id}/delete', [ApprovalStageController::class, 'destroy']);

    // Approvals
    Route::post('/selections/approvals/create', [ApprovalController::class, 'createApprovalForSelection']);
    Route::delete('/selections/approvals/{id}/delete', [ApprovalController::class, 'deleteSelectionApproval']);
    Route::patch('/approvals/{id}/update-approval-status', [ApprovalController::class, 'updateApprovalStatus']);
});
