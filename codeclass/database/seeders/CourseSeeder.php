<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // Get the first teacher (or any user)
        $teacher = DB::table('users')->where('role', 'teacher')->first();
        $teacherId = $teacher ? $teacher->id : 1;

        DB::table('courses')->insert([
            [
                'user_id' => $teacherId,
                'title' => 'Introduction à Laravel',
                'description' => 'Apprenez les bases du framework Laravel.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $teacherId,
                'title' => 'Développement Web Avancé',
                'description' => 'Explorez les concepts avancés du développement web.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => $teacherId,
                'title' => 'Sécurité des Applications',
                'description' => 'Comprendre les principes de la sécurité applicative.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}