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
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\DroitController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\GoogleAuthController;



// Routes accessibles sans authentification
Route::middleware('guest')->group(function (): void {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/password/reset', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
});


Route::get('/auth/github', [SocialAuthController::class, 'redirect'])->name('auth.github');
Route::get('/auth/github/callback', [SocialAuthController::class, 'callback'])->name('auth.github.callback');

// Google
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('auth.google.callback');

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
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('/badges', [BadgeController::class, 'index'])->name('badges.index')->middleware('auth');
Route::get('/badge/create', [BadgeController::class, 'create'])->name('badge.create');
Route::post('/badge', [BadgeController::class, 'store'])->name('badge.store');
Route::get('/badge/{badge}/edit', [BadgeController::class, 'edit'])->name('badge.edit');
Route::delete('/badge/{badge}', [BadgeController::class, 'destroy'])->name('badge.destroy'); 
    Route::post('/projects', [ProjectsController::class, 'store'])->name('projects.store');
    
    // Droits utilisateurs
    Route::post('/droits/assign/', [DroitController::class, 'updateUserRights'])->name('droits.assign');
    
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

Route::post('/challenges/{id}/participate', [App\Http\Controllers\ChallengesController::class, 'participate'])->name('challenges.participate');
Route::put('/challenges/{id}/status', [App\Http\Controllers\ChallengesController::class, 'updateStatus'])->name('challenges.updateStatus');

use App\Http\Controllers\CertificationsController;

Route::get('/certifications', [CertificationsController::class, 'index'])->name('certifications');
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects')->middleware('auth');
use App\Http\Controllers\RessourcesController;
Route::get('/ressources', [RessourcesController::class, 'index'])->name('ressources');
Route::post('/ressources', [RessourcesController::class, 'store'])->name('ressources.store');
// Community routes
Route::get('/community', [App\Http\Controllers\CommunityController::class, 'index'])->name('community');
Route::post('/community/join', [App\Http\Controllers\CommunityController::class, 'join'])->name('community.join')->middleware('auth');
Route::post('/community/leave', [App\Http\Controllers\CommunityController::class, 'leave'])->name('community.leave')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
})->name('home');
// assignemnt routes
Route::post('/assign-project', [AssignmentController::class, 'assignProject'])->name('assign.project');
Route::post('/assign-course', [AssignmentController::class, 'assignCourse'])->name('assign.course');
Route::get('/codereview/{fileId?}', [ProjectsController::class, 'codeReview'])->name('codereview');
Route::post('/run-code/{fileId}', [ProjectsController::class, 'runCode']);

// Skill routes
Route::get('/skills', [SkillController::class, 'mySkills'])->middleware('auth');
Route::get('/skills/all', [SkillController::class, 'allSkills'])->middleware('auth');
Route::get('/skills/gaps/recommendations', [SkillController::class, 'skillGapsRecommendations'])->middleware('auth')->name('skills.gaps_recommendations');
use App\Http\Controllers\CodeExecutionController;
Route::post('/execute-code', [App\Http\Controllers\CodeExecutionController::class, 'executeCode'])->name('execute.code');
Route::patch('/projects/{project}/status', [ProjectsController::class, 'updateStatus'])->name('projects.update-status');
Route::patch('/projects/{project}/progress', [ProjectsController::class, 'updateProgress'])->name('projects.update-progress');
Route::get('/projects/{project}', [App\Http\Controllers\ProjectsController::class, 'show'])->name('projects.show');

Route::get('/projects/{project}/edit', [App\Http\Controllers\ProjectsController::class, 'edit'])->name('projects.edit');
Route::patch('/projects/{project}', [App\Http\Controllers\ProjectsController::class, 'update'])->name('projects.update');