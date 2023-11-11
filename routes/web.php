<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\NewPasswordController;
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

Route::get('/', function () {
    return Inertia::render('Index');
});

Route::prefix('auth')->middleware('guest')->group(function (){
    Route::get('/login',[AuthController::class,'create'])->name('login');
    Route::post('/login',[AuthController::class, 'store']);
    Route::get('/forgot-password',[ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password',[ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}',[NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password',[NewPasswordController::class, 'store'])->name('password.update');
});
