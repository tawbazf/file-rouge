<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
        // Example: adjust these queries to fit your schema!
        $students = \App\Models\User::where('role', 'user')->get();
        $activeStudents = $students->where('is_active', true)->count(); // If you have an 'is_active' column
        $totalStudents = $students->count();
    
        $classAverage = round($students->avg('average_grade'), 1); // If you have an 'average_grade' column
        $classAverageChange = '+2.3%'; // Compute as needed
    
        $homeworkSubmitted = 92; // Compute as needed (e.g., from a homeworks table)
        $globalProgress = 78; // Compute as needed
    
        // Progress by subject (assuming you have a grades table)
        $progressBySubject = [
            'math' => 85,
            'science' => 72,
            'history' => 68,
        ];
    
        // Grade distribution (example: count students in each range)
        $gradeDistribution = [
            '0-5' => 2,
            '6-10' => 5,
            '11-14' => 12,
            '15-17' => 8,
            '18-20' => 3,
        ];
    
        // List of students (with their stats)
        $studentRows = $students->map(function ($student) {
            return [
                'id' => $student->id,
                'name' => $student->name,
                'avatar' => $student->avatar ?? 'https://randomuser.me/api/portraits/men/32.jpg',
                'average' => $student->average_grade ?? 0,
                'progress' => $student->progress ?? 0,
                'last_activity' => $student->last_activity ? $student->last_activity->diffForHumans() : 'N/A',
            ];
        });
    
        return view('general-statistics', [
            'classAverage' => $classAverage,
            'classAverageChange' => $classAverageChange,
            'activeStudents' => $activeStudents,
            'totalStudents' => $totalStudents,
            'homeworkSubmitted' => $homeworkSubmitted,
            'globalProgress' => $globalProgress,
            'progressBySubject' => $progressBySubject,
            'gradeDistribution' => $gradeDistribution,
            'studentRows' => $studentRows,
        ]);
    }
}