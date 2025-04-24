<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CoursesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $courses = Course::paginate(10);
        return view('courses', compact('courses'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $course = new Course();
        $course->user_id = $user->id;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->save();

        return redirect()->route('courses')->with('success', 'Course added!');
    }
}