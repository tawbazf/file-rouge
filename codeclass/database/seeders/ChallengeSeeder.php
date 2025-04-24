<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChallengeSeeder extends Seeder
{
    public function run()
    {
        // Get some user IDs to associate challenges with
        $userIds = DB::table('users')->pluck('id')->take(3);

        $challenges = [
            [
                'user_id' => $userIds[0] ?? 1,
                'title' => '30-Day Coding Challenge',
                'date' => Carbon::now()->subDays(2)->toDateString(),
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[1] ?? 1,
                'title' => 'Laravel Mastery',
                'date' => Carbon::now()->subDays(10)->toDateString(),
                'status' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $userIds[2] ?? 1,
                'title' => 'Frontend Sprint',
                'date' => Carbon::now()->subDays(17)->toDateString(),
                'status' => 'not_started',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('challenges')->insert($challenges);
    }
}