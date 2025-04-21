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
Route::middleware('guest')->group(function (): void {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
});

// Authentification sociale (doit être en dehors du middleware guest)
// Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
// Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

// Route::get('/auth/github', [SocialAuthController::class, 'redirectToGithub'])->name('auth.github'); 

// Route::get('/auth/github/callback', [SocialAuthController::class, 'handleGithubCallback']);
// GitHub
Route::get('/auth/github', [SocialAuthController::class, 'redirectToGithub'])->name('auth.github');
Route::get('/auth/github/callback', [SocialAuthController::class, 'handleGithubCallback'])->name('auth.github.callback');

// Google
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Routes protégées par authentification
Route::middleware('auth')->group(function (): void {
    // Déconnexion
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Tableaux de bord
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard-prof', [DashboardProfController::class, 'index'])->name('dashboardProf');
    
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
// Route::get('/badges/create', [BadgeController::class, 'create'])->name('badge.create');
// Route::post('/badges', [BadgeController::class, 'store'])->name('badge.store');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/badges', [BadgeController::class, 'index'])->name('badges.index');
Route::get('/badge/create', [BadgeController::class, 'create'])->name('badge.create');
Route::post('/badge', [BadgeController::class, 'store'])->name('badge.store');
    // Projets
    Route::post('/projects', [ProjetController::class, 'store'])->name('projects.store');
    
    // Droits utilisateurs
    Route::post('/users/{userId}/update-rights', [DroitController::class, 'updateUserRights'])
         ->name('users.updateRights');
    
    // Home (optionnel)
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
use App\Http\Controllers\CoursesController;

Route::get('/courses', [CoursesController::class, 'index'])->name('courses');
Route::post('/courses', [CoursesController::class, 'store'])->name('courses.store');

use App\Http\Controllers\CommunityController;

Route::get('/community', [CommunityController::class, 'index'])->name('community');
Route::post('/community', [CommunityController::class, 'store'])->name('community.store');


use App\Http\Controllers\ChallengesController;

Route::get('/challenges', [ChallengesController::class, 'index'])->name('challenges');
Route::post('/challenges', [ChallengesController::class, 'store'])->name('challenges.store');
use App\Http\Controllers\CertificationsController;

Route::get('/certifications', [CertificationsController::class, 'index'])->name('certifications');
use App\Http\Controllers\ProjectsController;
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
use App\Http\Controllers\RessourcesController;
Route::get('/ressources', [RessourcesController::class, 'index'])->name('ressources');
Route::post('/ressources', [RessourcesController::class, 'store'])->name('ressources.store');
Route::view('/community', 'community')->name('community');
Route::get('/', function () {
    return view('welcome');
})->name('home');