<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { DB::table('users')->truncate();
        DB::table('users')->insert([
            [
                
                'name' => 'Student User',
                'email' => 'student@example.com',
                'github_id' => 'student123', // Example GitHub ID
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'user',
                'avatar' => 'https://randomuser.me/api/portraits/men/32.jpg',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
               
                'name' => 'Teacher User',
                'email' => 'teacher@example.com',
                'github_id' => 'teacher456', // Example GitHub ID
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'role' => 'teacher',
                'avatar' => 'https://randomuser.me/api/portraits/women/32.jpg',
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}