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
use App\Http\Controllers\RoleSelectionController;
// Route pour afficher la page de sélection de rôle
Route::get('/choose-role', [RoleSelectionController::class, 'show'])->name('choose.role');

// Route pour gérer la soumission du rôle sélectionné
Route::post('/choose-role', [RoleSelectionController::class, 'store'])->name('choose.role.submit');

// Routes protégées par le middleware auth
Route::middleware(['auth'])->group(function () {
    // Tableau de bord pour les utilisateurs
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tableau de bord pour les enseignants
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');use App\Http\Controllers\NotificationController;

// Routes protégées par le middleware auth
Route::middleware(['auth'])->group(function () {
    // Route pour les notifications des étudiants
    Route::get('/notifications/student', [NotificationController::class, 'studentNotifications'])->name('notifications.student');

    // Route pour les notifications des enseignants
    Route::get('/notifications/teacher', [NotificationController::class, 'teacherNotifications'])->name('notifications.teacher');
});
use App\Http\Controllers\StatisticsController;

Route::middleware(['auth'])->group(function () {
    // Route pour les statistiques générales
    Route::get('/general-statistics', [StatisticsController::class, 'index'])->name('general.statistics');
});
use App\Http\Controllers\CodeCollabController;

Route::middleware(['auth'])->group(function () {
    // Route pour la collaboration
    Route::get('/code-collab', [CodeCollabController::class, 'index'])->name('code.collab');
});
use App\Http\Controllers\CodeReviewController;

Route::middleware(['auth'])->group(function () {
    // Route for the Code Review view
    Route::get('/code-review', [CodeReviewController::class, 'index'])->name('code.review');
});
use App\Http\Controllers\BadgeController;

Route::middleware(['auth'])->group(function () {
    // Route to display the badge creation form
    Route::get('/badge/create', [BadgeController::class, 'create'])->name('badge.create');

    // Route to handle badge creation form submission
    Route::post('/badge/create', [BadgeController::class, 'store'])->name('badge.store');
});use App\Http\Controllers\ProjetController;

Route::middleware(['auth'])->group(function () {
    Route::resource('projects', ProjetController::class);
});use App\Http\Controllers\DroitController;

Route::middleware(['auth'])->group(function () {
    // Route to update user rights (only accessible by teachers)
    Route::post('/users/{userId}/update-rights', [DroitController::class, 'updateUserRights'])->name('users.updateRights');
});