<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\LogbookController;
use App\Http\Controllers\Teacher\ProfileController;
use App\Http\Controllers\Teacher\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/')->uses([DashboardController::class, 'index'])->name('teacher.dashboard');

Route::prefix('tugas')->group(function () {
    Route::get('/')->uses([TaskController::class, 'index'])->name('teacher.task_index');
    Route::get('/{id}')->uses([TaskController::class, 'show'])->name('teacher.detail_task');
    Route::get('/{id}/download')->uses([FileController::class, 'download'])->name('teacher.download_task_file');
    Route::get('/{id}/setujui')->uses([TaskController::class, 'approve'])->name('teacher.approve_task');
});

Route::prefix('logbook')->group(function () {
    Route::get('/', [LogbookController::class, 'index'])->name('teacher.logbook_index');
    Route::get('/{id}', [LogbookController::class, 'show'])->name('teacher.detail_logbook');
});

Route::prefix('profil')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('teacher.profile');
    Route::put('/update', [ProfileController::class, 'update'])->name('teacher.update_profile');
});
