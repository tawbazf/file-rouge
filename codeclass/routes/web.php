<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;

Route::get('/', function () {
    return view('welcome');
});Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


// Google Authentication Routes
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// GitHub Authentication Routes
Route::get('/auth/github', [SocialAuthController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/auth/github/callback', [SocialAuthController::class, 'handleGithubCallback']);
use Illuminate\Support\Facades\Auth;

Auth::routes(); 
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
