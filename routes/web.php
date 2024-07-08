<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\auth;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->middleware(auth::class)->name('dashboard');
});


Route::group(['prefix' => 'auth'], function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'authenticate'])->name('login.authenticate');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::put('register', [AuthController::class, 'store'])->name('register.store');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

});
