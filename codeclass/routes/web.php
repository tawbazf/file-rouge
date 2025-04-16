<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProfController;
use App\Http\Controllers\RoleSelectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\CodeCollabController;
use App\Http\Controllers\CodeReviewController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\DroitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes accessibles sans authentification
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
});

// Authentification sociale (doit être en dehors du middleware guest)
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::get('/auth/github', [SocialAuthController::class, 'redirectToGithub'])->name('auth.github'); 

Route::get('/auth/github/callback', [SocialAuthController::class, 'handleGithubCallback']);

// Routes protégées par authentification
Route::middleware('auth')->group(function () {
    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Tableaux de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-prof', [DashboardProfController::class, 'index'])->name('dashboard.prof');
    
    // Sélection de rôle
    Route::get('/choose-role', [RoleSelectionController::class, 'show'])->name('choose.role');
    Route::post('/choose-role', [RoleSelectionController::class, 'store'])->name('choose.role.submit');
    
    // Notifications
    Route::get('/notifications/students', [NotificationController::class, 'studentNotifications'])
         ->name('notifications.student');
    Route::get('/notifications/teacher', [NotificationController::class, 'teacherNotifications'])
         ->name('notifications.teacher');
    
    // Statistiques
    Route::get('/general-statistics', [StatisticsController::class, 'index'])->name('general.statistics');
    
    // Collaboration de code
    Route::get('/code-collab', [CodeCollabController::class, 'index'])->name('code.collab');
    
    // Revue de code
    Route::get('/code-review', [CodeReviewController::class, 'index'])->name('code.review');
    
    // Badges
    Route::prefix('badge')->group(function () {
        Route::get('/create', [BadgeController::class, 'create'])->name('badge.create');
        Route::post('/create', [BadgeController::class, 'store'])->name('badge.store');
    });
    
    // Projets
    Route::resource('projects', ProjetController::class);
    
    // Droits utilisateurs
    Route::post('/users/{userId}/update-rights', [DroitController::class, 'updateUserRights'])
         ->name('users.updateRights');
    
    // Home (optionnel)
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});