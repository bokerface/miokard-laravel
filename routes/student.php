<?php

use App\Http\Controllers\Student\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('tugas')->group(function () {
    Route::get('/')->uses([TaskController::class, 'index'])->name('student.task_index');
    Route::get('unggah-tugas')->uses([TaskController::class, 'create'])->name('student.create_task');
    Route::post('unggah-tugas')->uses([TaskController::class, 'store'])->name('student.store_task');
});
