<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\AssignmentAssigned;
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
$assignment = Assignment::create([
    'title' => 'Exemple',
    'description' => 'Texte...',
    'due_date' => now()->addWeek(),
    'created_by' => auth()->id(),
]);

$assignment->students()->sync([2, 3, 4]); 
foreach ($assignment->students as $student) {
    $student->notify(new AssignmentAssigned($assignment));
}