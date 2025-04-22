<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssignmentPivotSeeder extends Seeder
{
    public function run()
    {
        // Get some teachers and students
        $teacher = DB::table('users')->where('role', 'teacher')->first();
        $students = DB::table('users')->where('role', 'student')->take(3)->get();

        // Get some courses and projects
        $courses = DB::table('courses')->take(2)->get();
        $projects = DB::table('projects')->take(2)->get();

        foreach ($students as $student) {
            // Assign each course and project to each student by the teacher
            foreach ($courses as $course) {
                DB::table('course_user')->insert([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'assigned_by' => $teacher ? $teacher->id : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            foreach ($projects as $project) {
                DB::table('project_user')->insert([
                    'user_id' => $student->id,
                    'project_id' => $project->id,
                    'assigned_by' => $teacher ? $teacher->id : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}