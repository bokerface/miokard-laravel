<?php

use App\Http\Controllers\FileController;
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

Route::group([], function () {
    Route::get('preview-file', [FileController::class, 'preview'])->name('file.preview');
    Route::get('foto-profile', [FileController::class, 'profilePicture'])->name('user.profile_picture');
});
