<?php

use App\Http\Controllers\Student\LogbookController;
use App\Http\Controllers\Student\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('tugas')->group(function () {
    Route::get('/')->uses([TaskController::class, 'index'])->name('student.task_index');
    Route::get('unggah-tugas')->uses([TaskController::class, 'create'])->name('student.create_task');
    Route::post('unggah-tugas')->uses([TaskController::class, 'store'])->name('student.store_task');
    Route::get('/{id}')->uses([TaskController::class, 'edit'])->name('student.detail_task');
    Route::put('/{id}/update')->uses([TaskController::class, 'update'])->name('student.update_task');
});

Route::prefix('logbook')->group(function () {
    Route::get('/')->uses([LogbookController::class, 'index'])->name('student.logbook_index');
    Route::get('create')->uses([LogbookController::class, 'create'])->name('student.create_logbook');
    Route::post('create')->uses([LogbookController::class, 'store'])->name('student.store_logbook');
    Route::get('/{id}')->uses([LogbookController::class, 'edit'])->name('student.edit_logbook');
    Route::put('/{id}/update')->uses([LogbookController::class, 'update'])->name('student.update_logbook');
    Route::delete('/{id}/delete')->uses([LogbookController::class, 'destroy'])->name('student.delete_logbook');
});
