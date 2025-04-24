<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }
    public function run(): void
{
    $this->call([
        UsersTableSeeder::class,
        ProjectSeeder::class, 
    ]);
    $this->call(BadgesTableSeeder::class);
    $this->call(AssignmentSeeder::class);
    $this->call(AssignmentPivotSeeder::class);
    $this->call(CourseSeeder::class);
    $this->call(CertificationsTableSeeder::class);
    $this->call(SkillSeeder::class);
    $this->call(ChallengeSeeder::class);
}
}