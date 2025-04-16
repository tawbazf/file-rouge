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
        // For example, if projects are linked by user_id:
// $projects = Project::where('user_id', $teacher->id)->get();
        $projects = Project::where('teacher_id', $teacher->id)->with(['students'])->get();

        // Build project cards for the dashboard
        $projectCards = $projects->map(function ($project) {
            // Example status logic (adapt as needed)
            if ($project->status === 'in_progress') {
                $badge = ['text' => 'En cours', 'color' => 'green'];
            } elseif ($project->status === 'upcoming') {
                $badge = ['text' => 'À venir', 'color' => 'yellow'];
            } elseif ($project->status === 'urgent') {
                $badge = ['text' => 'Urgent', 'color' => 'red'];
            } else {
                $badge = ['text' => ucfirst($project->status), 'color' => 'gray'];
            }

            return [
                'name' => $project->name,
                'description' => $project->description,
                'deadline' => $project->deadline ? Carbon::parse($project->deadline)->translatedFormat('d M Y') : null,
                'badge' => $badge,
                'repo_count' => $project->repositories->count() ?? 0,
                'students' => $project->students->map(function ($student) {
                    return [
                        'name' => $student->name,
                        'avatar' => $student->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg'
                    ];
                }),
            ];
        });

        // 2. GitHub repositories table (adapt model/relations as needed)
        $repositories = GithubRepository::with(['project', 'student'])
            ->whereHas('project', function ($q) use ($teacher) {
                $q->where('teacher_id', $teacher->id);
            })
            ->latest('updated_at')
            ->limit(10)
            ->get();

        $repoTable = $repositories->map(function ($repo) {
            return [
                'project_name' => $repo->project->name,
                'student_name' => $repo->student->name,
                'student_avatar' => $repo->student->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg',
                'last_commit' => $repo->updated_at->diffForHumans(),
                'status' => $repo->status, // e.g. 'Actif'
                'actions' => route('repo.view', $repo->id),
            ];
        });

        return view('dashboardProf', [
            'teacher' => $teacher,
            'projectCards' => $projectCards,
            'repoTable' => $repoTable,
        ]);
    }
}