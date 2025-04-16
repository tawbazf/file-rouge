<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Example: Get all projects for the user
        $projects = Project::where('user_id', $user->id)->get();

        // Calculate global progress (example logic, adapt as needed)
        $totalProjects = $projects->count();
        $completedProjects = $projects->where('status', 'completed')->count();
        $globalProgress = $totalProjects > 0 ? intval(($completedProjects / $totalProjects) * 100) : 0;

        // Projects completed this week
        $projectsThisWeek = $projects->where('status', 'completed')
            ->filter(function ($project) {
                return $project->updated_at >= Carbon::now()->startOfWeek();
            })->count();

        // Learning time (example: sum of all project durations, adapt as needed)
        $learningTimeHours = $projects->sum('learning_time'); // Assume 'learning_time' is in hours

        // Learning time this week (example)
        $learningTimeThisWeek = $projects->where('updated_at', '>=', Carbon::now()->startOfWeek())->sum('learning_time');

        // Current projects (not completed)
        $currentProjects = $projects->where('status', '!=', 'completed');

        // Example project cards: you may want to map your $currentProjects to include name, status, time remaining, and progress
        $projectCards = $currentProjects->map(function ($project) {
            return [
                'name' => $project->name,
                'status' => $project->status, // e.g., 'En cours', 'À débuter', 'Presque fini'
                'time_remaining' => $project->time_remaining, // e.g., '2h restantes'
                'progress' => $project->progress, // e.g., 65
            ];
        });

        return view('dashboard', [
            'user' => $user,
            'globalProgress' => $globalProgress,
            'completedProjects' => $completedProjects,
            'projectsThisWeek' => $projectsThisWeek,
            'learningTimeHours' => $learningTimeHours,
            'learningTimeThisWeek' => $learningTimeThisWeek,
            'projectCards' => $projectCards,
        ]);
    }
}