<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\GithubRepository;
use App\Models\User;
use Carbon\Carbon;

class DashboardProfController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
    
        // Vérifier si l'utilisateur est un professeur
        if ($teacher->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }
    
        // 1. Projects managed by this teacher
        $projects = \App\Models\Project::where('teacher_id', $teacher->id)
            ->with(['students', 'repositories']) // eager load relations if they exist
            ->get();
    
        // Build project cards for the dashboard
        $projectCards = $projects->map(function ($project) {
            // Badge logic based on status
            if ($project->status === 'in_progress') {
                $badge = ['text' => 'En cours', 'color' => 'green'];
            } elseif ($project->status === 'completed') {
                $badge = ['text' => 'Terminé', 'color' => 'gray'];
            } elseif ($project->status === 'not_started') {
                $badge = ['text' => 'Non commencé', 'color' => 'yellow'];
            } else {
                $badge = ['text' => ucfirst($project->status), 'color' => 'gray'];
            }
    
            return [
                'name' => $project->title, // Use 'title' as per your DB
                'description' => $project->description,
                'deadline' => $project->deadline ?? null, // If you have a deadline field
                'badge' => $badge,
                'repo_count' => $project->repositories ? $project->repositories->count() : 0,
                'students' => $project->students ? $project->students->map(function ($student) {
                    return [
                        'name' => $student->name,
                        'avatar' => $student->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg'
                    ];
                }) : [],
            ];
        });
    
        // 2. GitHub repositories table (optional, adapt if needed)
        $repoTable = [];
        if (class_exists('\App\Models\GithubRepository')) {
            $repositories = \App\Models\GithubRepository::with(['project', 'student'])
                ->whereHas('project', function ($q) use ($teacher) {
                    $q->where('teacher_id', $teacher->id);
                })
                ->latest('updated_at')
                ->limit(10)
                ->get();
    
            $repoTable = $repositories->map(function ($repo) {
                return [
                    'project_name' => $repo->project->title ?? '',
                    'student_name' => $repo->student->name ?? '',
                    'student_avatar' => $repo->student->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg',
                    'last_commit' => $repo->updated_at->diffForHumans(),
                    'status' => $repo->status ?? '',
                    'actions' => route('repo.view', $repo->id),
                ];
            });
        }
    
        return view('dashboardProf', [
            'teacher' => $teacher,
            'projectCards' => $projectCards,
            'repoTable' => $repoTable,
        ]);
    }
}