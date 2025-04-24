<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;

class StatisticsController extends Controller
{
    public function index()
    {
       
        $students = User::where('role', 'user')->paginate(10); 
        $activeStudents = $students->where('is_active', true)->count(); 
        $totalStudents = $students->count();
        $courses = Course::all();
        $classAverage = round($students->avg('average_grade'), 1); 
        $classAverageChange = '+2.3%'; 
    
        $homeworkSubmitted = 92; 
        $globalProgress = 78; 
        $courseProgress = $courses->map(function($course) {
            return [
                'name' => $course->name,
                'progress' => $course->progress ?? 0,
            ];
        });
      
        $progressBySubject = [
            'math' => 85,
            'science' => 72,
            'history' => 68,
        ];
    
       
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
            'students' => $students,
            'studentRows' => $studentRows,
            'courseProgress' => $courseProgress,
        ]);
    }

}