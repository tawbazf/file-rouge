<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\GithubRepository;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

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

        // 1. Projects managed by this teacher
        $teacherProjects = Project::where('teacher_id', $teacher->id)
            ->with(['students', 'repositories'])
            ->get();

        // Build project cards for the dashboard
        $projectCards = $teacherProjects->map(function ($project) {
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
                'name' => $project->title,
                'description' => $project->description,
                'deadline' => $project->deadline ?? null,
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

        // 2. GitHub repositories table
        $repositories = GithubRepository::with(['project', 'student'])
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
                'last_commit' => $repo->updated_at ? $repo->updated_at->diffForHumans() : '',
                'status' => $repo->status ?? '',
                'actions' => route('repo.view', $repo->id), // adjust route if needed
            ];
        });

        // Pass everything needed to the view
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