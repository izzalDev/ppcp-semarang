<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\OtherBrowserSessionController;
use App\Http\Controllers\PhotoProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileInformationController;
use App\Http\Controllers\UserController;
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
Route::post('/auth/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('auth')->middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store']);
    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('/', [ProfileInformationController::class, 'show'])->name('profile');
    Route::put('/update-information', [ProfileInformationController::class, 'update'])->name('profile-information.update');
    Route::put('/update-password', [NewPasswordController::class, 'update'])->name('profile-password.update');
    Route::delete('/logout-other-browser', [OtherBrowserSessionController::class, 'destroy'])->name('logout-other-browser');
    Route::put('/update-photo', [PhotoProfileController::class, 'update'])->name('photo-profile.post');
});

Route::prefix('/')->middleware('auth')->group(function () {
    Route::resource('/user', UserController::class);
    Route::resource('/category', CategoryController::class);
    Route::resource('/product', ProductController::class);
});

Route::prefix('assets')->middleware('auth')->group(function () {
    Route::get('/profile-picture/{filename}', [PhotoProfileController::class, 'show'])->name('photo-profile.show');
});
