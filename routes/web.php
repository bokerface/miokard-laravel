<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileController;
use App\Http\Middleware\AuthCheck;
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
    if (auth()->check() && auth()->user()->role_id != 1) {
        # code...
    }

    // if user role is student
    if (auth()->check() && auth()->user()->role_id != 2) {
        # code...
    }

    // if user role is teacher
    if (auth()->check() && auth()->user()->role_id != 3) {
        # code...
    }
});

Route::middleware(AuthCheck::class)
    ->prefix('login')
    ->group(function () {
        Route::get('/', [AuthController::class, 'login'])->name('login');
        Route::post('/', [AuthController::class, 'loginProcess'])->name('login.post');
    });



Route::group([], function () {
    Route::get('preview-file', [FileController::class, 'preview'])->name('file.preview');
    Route::get('foto-profile', [FileController::class, 'profilePicture'])->name('user.profile_picture');
});
