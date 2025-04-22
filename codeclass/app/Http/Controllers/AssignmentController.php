<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function assignProject(Request $request)
{
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'user_ids' => 'required|array',
    ]);
    $teacherId = Auth::id();

    foreach ($request->user_ids as $userId) {
        DB::table('project_user')->updateOrInsert(
            [
                'project_id' => $request->project_id,
                'user_id' => $userId,
            ],
            [
                'assigned_by' => $teacherId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    return back()->with('success', 'Projet assigné !');
}
public function assignCourse(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'user_ids' => 'required|array',
    ]);
    $teacherId = Auth::id();

    foreach ($request->user_ids as $userId) {
        DB::table('course_user')->updateOrInsert(
            [
                'course_id' => $request->course_id,
                'user_id' => $userId,
            ],
            [
                'assigned_by' => $teacherId,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    return back()->with('success', 'Cours assigné !');
}
}
