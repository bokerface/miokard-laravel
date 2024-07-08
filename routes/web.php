<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\GuestCheck;
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
    if (auth()->check() && auth()->user()->role_id == 1) {
        return redirect()->route('admin.dashboard');
    }

    // if user role is student
    if (auth()->check() && auth()->user()->role_id == 2) {
        return redirect()->route('student.dashboard');
    }

    // if user role is teacher
    if (auth()->check() && auth()->user()->role_id == 3) {
        return redirect()->route('teacher.dashboard');
    }

    return redirect()->route('login');
});

Route::middleware(GuestCheck::class)->prefix('login')
    ->group(function () {
        Route::get('/', [AuthController::class, 'login'])->name('login');
        Route::post('/', [AuthController::class, 'loginProcess'])->name('login.post');
    });

Route::middleware(GuestCheck::class)
    ->group(function () {
        Route::get('/forgot-password', [ResetPasswordController::class, 'requestPasswordResetLink'])->name('forgot-password');
        Route::post('/forgot-password', [ResetPasswordController::class, 'requestPasswordResetLinkProcess'])->name('forgot-password.post');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'submitNewPassword'])->name('password.update');
    });

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group([], function () {
    Route::get('preview-file', [FileController::class, 'preview'])->name('file.preview');
    Route::get('foto-profile', [FileController::class, 'profilePicture'])->name('user.profile_picture');
});

// Route::get('mail', function () {
//     $url = route('student.detail_task', ['id' => 1]);

//     return new App\Mail\TaskSubmitted($url);
// });
