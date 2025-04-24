<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CertificationsTableSeeder extends Seeder
{
    public function run()
    {
        // Get some user IDs to associate certifications with
        $userIds = DB::table('users')->pluck('id')->take(3);

        $certifications = [
            [
                'user_id' => $userIds[0] ?? 1,
                'title' => 'Laravel Developer Certification',
                'date' => Carbon::now()->subDays(10)->toDateString(),
                'badge' => 'laravel_badge.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[1] ?? 1,
                'title' => 'Frontend Mastery',
                'date' => Carbon::now()->subDays(30)->toDateString(),
                'badge' => 'frontend_badge.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[2] ?? 1,
                'title' => 'Database Specialist',
                'date' => Carbon::now()->subDays(60)->toDateString(),
                'badge' => 'database_badge.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('certifications')->insert($certifications);
    }
}