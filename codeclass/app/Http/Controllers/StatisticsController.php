<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
      
        $subjects = \DB::table('subjects')->pluck('name', 'id');
        $grades = \DB::table('grades')
            ->select('subject_id', \DB::raw('AVG(grade) as average'))
            ->groupBy('subject_id')
            ->pluck('average', 'subject_id');
        
        $progressBySubject = [];
        foreach ($subjects as $id => $name) {
            $progressBySubject[$name] = isset($grades[$id]) ? $grades[$id] : 0;
        }
    
       
        $gradeDistribution = [
            '0-5' => \DB::table('grades')->whereBetween('grade', [0, 5])->count(),
            '6-10' => \DB::table('grades')->whereBetween('grade', [6, 10])->count(),
            '11-14' => \DB::table('grades')->whereBetween('grade', [11, 14])->count(),
            '15-17' => \DB::table('grades')->whereBetween('grade', [15, 17])->count(),
            '18-20' => \DB::table('grades')->whereBetween('grade', [18, 20])->count(),
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