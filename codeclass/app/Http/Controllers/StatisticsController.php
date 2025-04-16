<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        // Fetch all students (assuming 'role' field exists)
        $students = User::where('role', 'student')->get();

        $totalStudents = $students->count();
        $activeStudents = $students->filter(function($student) {
            // Consider as active if last_activity is within the last 24 hours
            return isset($student->last_activity) && Carbon::parse($student->last_activity)->gt(Carbon::now()->subDay());
        })->count();

        // Class average (assuming 'average' field exists)
        $classAverage = $students->avg('average') ? round($students->avg('average'), 1) : 0;

        // Homework completion (static or calculated if you have a field)
        $homeworkCompletion = 92; // Static fallback

        // Global progress (assuming 'progress' field exists)
        $globalProgress = $students->avg('progress') ? round($students->avg('progress')) : 0;

        // Subject progress (static for now)
        $subjectProgress = [
            'math' => 85,
            'science' => 72,
            'history' => 68,
        ];

        // Grade distribution (static for now)
        $gradeDistribution = [
            '0-5' => 2,
            '6-10' => 5,
            '11-14' => 12,
            '15-17' => 8,
            '18-20' => 3,
        ];

        // Student list for the view
        $studentList = $students->map(function ($student) {
            return [
                'id' => $student->student_id ?? $student->id,
                'name' => $student->name,
                'avatar' => $student->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg',
                'average' => $student->average ?? 0,
                'progress' => $student->progress ?? 0,
                'lastActivity' => $student->last_activity
                    ? Carbon::parse($student->last_activity)->diffForHumans()
                    : 'Inconnu',
            ];
        });

        return view('general-statistics', [
            'classAverage' => $classAverage,
            'activeStudents' => $activeStudents,
            'totalStudents' => $totalStudents,
            'homeworkCompletion' => $homeworkCompletion,
            'globalProgress' => $globalProgress,
            'students' => $studentList,
            'subjectProgress' => $subjectProgress,
            'gradeDistribution' => $gradeDistribution,
        ]);
    }
}