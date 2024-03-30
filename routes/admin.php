<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('/')->uses([UserController::class, 'index'])->name('admin.user_index');
    Route::get('create-student')->uses([UserController::class, 'createStudentAccount'])->name('admin.create_student');
    Route::post('create-student')->uses([UserController::class, 'storeStudent'])->name('admin.store_student');
    Route::get('create-teacher')->uses([UserController::class, 'createTeacherAccount'])->name('admin.create_teacher');
    Route::post('create-teacher')->uses([UserController::class, 'storeTeacher'])->name('admin.store_teacher');
});
