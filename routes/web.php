<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Middleware\auth;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware(auth::class)->name('dashboard');
});
Route::get('/unauthorized', function () {
    return view('unauthorized');
})->name('unauthorized');



Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('auth.login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('auth.login.authenticate');
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    Route::put('register', [AuthController::class, 'store'])->name('auth.register.store');
    Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::get('reset-password/{reset_token?}', [PasswordController::class, 'index'])->name('auth.reset-password');
    Route::post('request-reset', [PasswordController::class, 'store'])->name('auth.request-reset');
    Route::get('confirmation', function () {
       return view('auth.confirmation');
    })->name('auth.confirmation');
    Route::patch('reset-password/{user}', [PasswordController::class, 'update'])->name('auth.reset-password.update');
});

Route::get('/post', [AdminController::class, 'index'])->name('admin.index');
