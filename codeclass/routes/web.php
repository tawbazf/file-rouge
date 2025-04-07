<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
 use App\Http\Controllers\DashboardController;
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
use App\Http\Controllers\DashboardProfController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-prof', [DashboardProfController::class, 'index'])->name('dashboard.prof');
});
// Google Authentication Routes
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// GitHub Authentication Routes
Route::get('/auth/github', [SocialAuthController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/auth/github/callback', [SocialAuthController::class, 'handleGithubCallback']);
// use Illuminate\Support\Facades\Auth;

// Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');