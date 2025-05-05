<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $communities = [
            [
                'name' => 'Web Development',
                'description' => 'Connect with fellow Web Development enthusiasts, share resources, and collaborate on projects.',
                'category' => 'Programming',
                'member_count' => 0, // Will be updated by the CommunityMemberSeeder
                'discussion_count' => rand(10, 50),
            ],
            [
                'name' => 'Mobile Apps',
                'description' => 'Discuss mobile app development, share tips and tricks, and get feedback on your projects.',
                'category' => 'Programming',
                'member_count' => 0,
                'discussion_count' => rand(10, 50),
            ],
            [
                'name' => 'Data Science',
                'description' => 'Explore data science concepts, machine learning algorithms, and data visualization techniques.',
                'category' => 'Data',
                'member_count' => 0,
                'discussion_count' => rand(10, 50),
            ],
            [
                'name' => 'DevOps',
                'description' => 'Learn about DevOps practices, CI/CD pipelines, and infrastructure as code.',
                'category' => 'Operations',
                'member_count' => 0,
                'discussion_count' => rand(10, 50),
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Share UI/UX design principles, tools, and get feedback on your designs.',
                'category' => 'Design',
                'member_count' => 0,
                'discussion_count' => rand(10, 50),
            ],
            [
                'name' => 'Game Development',
                'description' => 'Discuss game development techniques, engines, and share your game projects.',
                'category' => 'Programming',
                'member_count' => 0,
                'discussion_count' => rand(10, 50),
            ],
        ];

        foreach ($communities as $community) {
            Community::create($community);
        }
    }
}