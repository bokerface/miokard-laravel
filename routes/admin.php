<?php

use App\Http\Controllers\Admin\ClinicalRotationSupervisorController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::get('/')->uses([UserController::class, 'index'])->name('admin.user_index');
    Route::get('create-student')->uses([UserController::class, 'createStudentAccount'])->name('admin.create_student');
    Route::post('create-student')->uses([UserController::class, 'storeStudent'])->name('admin.store_student');
    Route::get('create-teacher')->uses([UserController::class, 'createTeacherAccount'])->name('admin.create_teacher');
    Route::post('create-teacher')->uses([UserController::class, 'storeTeacher'])->name('admin.store_teacher');
    Route::get('/{id}')->uses([UserController::class, 'show'])->name('admin.user_detail');
    Route::delete('/{id}/delete')->uses([UserController::class, 'destroy'])->name('admin.delete_user');
});

Route::prefix('supervisor')->group(function () {
    Route::get('/')->uses([ClinicalRotationSupervisorController::class, 'index'])->name('admin.supervisor_index');
    Route::get('/{id}/ganti')->uses([ClinicalRotationSupervisorController::class, 'changeClinicalRotationSupervisor'])->name('admin.change_supervisor');
    Route::put('/{id}/ganti')->uses([ClinicalRotationSupervisorController::class, 'updateClinicalRotationSupervisor'])->name('admin.update_supervisor');
    Route::get('/{id}/tambah')->uses([ClinicalRotationSupervisorController::class, 'addClinicalRotationSupervisor'])->name('admin.add_supervisor');
    Route::post('/{id}/tambah')->uses([ClinicalRotationSupervisorController::class, 'storeClinicalRotationSupervisor'])->name('admin.store_supervisor');
    Route::delete('/{id}/hapus')->uses([ClinicalRotationSupervisorController::class, 'destroy'])->name('admin.remove_supervisor');
});

Route::prefix('dosen')->group(function () {
    Route::get('/{id}/ppds-bimbingan')->uses([TeacherController::class, 'show'])->name('admin.teacher_mentees');
    Route::get('/{id}/tambah-ppds-bimbingan')->uses([TeacherController::class, 'create'])->name('admin.add_teacher_mentees');
    Route::post('/{id}/tambah-ppds-bimbingan')->uses([TeacherController::class, 'storeMentee'])->name('admin.store_teacher_mentee');
    Route::delete('hapus-ppds-bimbingan/{id}')->uses([TeacherController::class, 'deleteMentee'])->name('admin.delete_mentee');
});

Route::get('/dosen-by-name-api')->uses([ClinicalRotationSupervisorController::class, 'getSupervisorByName'])->name('admin.get_supervisor_by_name');

Route::get('/student-by-name-api')->uses([StudentController::class, 'getStudentByName'])->name('admin.get_student_by_name');
