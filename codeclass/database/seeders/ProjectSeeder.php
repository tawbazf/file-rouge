<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->truncate();
        // Insert sample projects
        $projects = [
            [
                
                'title' => 'Introduction au HTML/CSS',
                'description' => 'Apprendre les bases du HTML et CSS pour créer des pages web.',
                'status' => 'completed',
                'progress' => 65,
                'time_remaining' => '2h restantes',
                'deadline' => Carbon::now()->addDays(14),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'last_collaboration' => Carbon::now()->addDays(7),
                'approved' => true,
                'user_id' => 1, // Student
                'teacher_id' => 2, // Teacher
            ],
            [
                
                'title' => 'JavaScript Basics',
                'description' => 'Introduction aux concepts fondamentaux de JavaScript.',
                'status' => 'not_started',
                'progress' => 0,
              
                'time_remaining' => '4h estimées',
                'deadline' => Carbon::now()->addDays(20),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'last_collaboration' => Carbon::now()->addDays(10),
                'approved' => false,
                'user_id' => 1,
                'teacher_id' => 2,
            ],
            [
                
                'title' => 'Responsive Design',
                'description' => 'Créer des interfaces adaptatives avec CSS Grid et Flexbox.',
                'status' => 'in_progress',
                'progress' => 90,
               
                'time_remaining' => '30min restantes',
                'deadline' => Carbon::now()->addDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'last_collaboration' => Carbon::now()->addDays(3),
                'approved' => true,
                'user_id' => 1,
                'teacher_id' => 2,
            ],
            [
                
                'title' => 'Portfolio Website',
                'description' => 'Construire un site portfolio personnel.',
                'status' => 'completed',
                'progress' => 100,
                
                'time_remaining' => '0h',
                'deadline' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
                'last_collaboration' => Carbon::now()->subDays(2),
                'approved' => true,
                'user_id' => 1,
                'teacher_id' => 2,
            ],
            [
                
                'title' => 'API Integration',
                'description' => 'Intégrer une API REST dans une application web.',
                'status' => 'completed',
                'progress' => 100,
                'time_remaining' => '11h',
                'deadline' => Carbon::now()->subDays(7),
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
                'last_collaboration' => Carbon::now()->subDays(4),
                'approved' => true,
                'user_id' => 1,
                'teacher_id' => 2,
            ],
        ];

        DB::table('projects')->insert($projects);

        // Insert project_user pivot data
        $projectUser = [
            [
                'user_id' => 1,
                'project_id' => 1,
                'status' => 'in_progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'project_id' => 2,
                'status' => 'not_started',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'project_id' => 3,
                'status' => 'in_progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'project_id' => 4,
                'status' => 'completed',
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 1,
                'project_id' => 5,
                'status' => 'completed',
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ],
        ];

        DB::table('project_user')->insert($projectUser);
    }
}
/* DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
DB::table('project_user')->truncate();
DB::table('projects')->truncate();
DB::table('users')->truncate();
DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
exit*/