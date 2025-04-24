<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\GithubRepository;
use App\Models\User;
use App\Models\Course;

class DashboardProfController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        // Security: Only allow teachers
        if ($teacher->role !== 'teacher') {
            return redirect()->route('dashboard')->with('error', 'Access denied.');
        }

        // For assignment modal
        $users = User::all();
        $courses = Course::all();
        $projects = Project::all();

      
        $teacherProjects = Project::where('teacher_id', $teacher->id)
            ->with(['students', 'repositories'])
            ->orderBy('created_at', 'desc')
            ->get();

    
        $projectCards = $teacherProjects->map(function ($project) {
            // Badge logic based on status
            switch ($project->status) {
                case 'in_progress':
                    $badge = ['text' => 'En cours', 'color' => 'green'];
                    break;
                case 'completed':
                    $badge = ['text' => 'Terminé', 'color' => 'gray'];
                    break;
                case 'not_started':
                    $badge = ['text' => 'Non commencé', 'color' => 'yellow'];
                    break;
                default:
                    $badge = ['text' => ucfirst($project->status), 'color' => 'gray'];
            }

            return [
                'name' => $project->title,
                'description' => $project->description,
                'deadline' => $project->time_remaining ?? null, // Use 'time_remaining' if that's what you want to show
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

        // GitHub repositories table
        $githubRepos = config('github_repos');
        $repositories = GithubRepository::with(['project', 'user'])
            ->whereHas('project', function ($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            })
            ->latest('updated_at')
            ->limit(10)
            ->get();

        $repoTable = $repositories->map(function ($repo) use ($githubRepos) {
            $randomRepo = $githubRepos ? $githubRepos[array_rand($githubRepos)] : ['html_url' => '#'];
            return [
                'project_name' => $repo->project->title ?? '',
                'student_name' => $repo->user->name ?? '',
                'student_avatar' => $repo->user->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg',
                'last_commit' => $repo->updated_at ? $repo->updated_at->diffForHumans() : '',
                'status' => $repo->status ?? '',
                'actions' => $randomRepo['html_url'] ?? '#',
            ];
        });

        
        return view('dashboardProf', [
            'teacher'      => $teacher,
            'users'        => $users,
            'courses'      => $courses,
            'projects'     => $projects,
            'projectCards' => $projectCards,
            'repoTable'    => $repoTable,
        ]);
    }
}