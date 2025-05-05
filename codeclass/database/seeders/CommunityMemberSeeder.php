<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\CommunityMember;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CommunityMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all users and communities
        $users = User::all();
        $communities = Community::all();
        
        // Make sure we have users and communities
        if ($users->isEmpty() || $communities->isEmpty()) {
            $this->command->info('No users or communities found. Please run the UserSeeder and CommunitySeeder first.');
            return;
        }
        
        // For each user, join random communities
        foreach ($users as $user) {
            // Each user joins 1-4 random communities
            $communitiesToJoin = $communities->random(rand(1, min(4, $communities->count())));
            
            foreach ($communitiesToJoin as $community) {
                // Create membership with a random join date in the past year
                CommunityMember::create([
                    'user_id' => $user->id,
                    'community_id' => $community->id,
                    'joined_at' => Carbon::now()->subDays(rand(1, 365)),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                
                // Increment the member count for this community
                $community->increment('member_count');
            }
        }
        
        $this->command->info('Community members seeded successfully.');
    }
}