<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\ProfileInformationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::post('/auth/logout',[AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('auth')->middleware('guest')->group(function (){
    Route::get('/login',[AuthController::class,'create'])->name('login');
    Route::post('/login',[AuthController::class, 'store']);
    Route::get('/forgot-password',[ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password',[ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}',[NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password',[NewPasswordController::class, 'store'])->name('password.update');
});

Route::prefix('profile')->middleware('auth')->group(function (){
    Route::get('/',[ProfileInformationController::class, 'show'])->name('profile');
    Route::put('/update-information',[ProfileInformationController::class, 'update'])->name('profile-information.update');
    Route::put('/update-password',[NewPasswordController::class, 'update'])->name('profile-password.update');
    Route::delete('/logout-other-browser', [\App\Http\Controllers\OtherBrowserSessionController::class, 'destroy'])->name('logout-other-browser');
    Route::put('/update-photo',[\App\Http\Controllers\PhotoProfileController::class, 'update'])->name('photo-profile.post');
});

Route::prefix('assets')->middleware('auth')->group(function (){
    Route::get('/profile-picture/{filename}',[\App\Http\Controllers\PhotoProfileController::class,'show'])->name('photo-profile.show');
});
