<?php

use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/')->uses([DashboardController::class, 'index'])->name('teacher.dashboard');

Route::prefix('tugas')->group(function () {
    Route::get('/')->uses([TaskController::class, 'index'])->name('teacher.task_index');
});
