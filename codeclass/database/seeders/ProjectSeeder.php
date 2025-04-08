<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        DB::table('projects')->insert([
            [
                'title' => 'CustomerCareAPI',
                'description' => 'An advanced Laravel API for customer support ticketing system.',
                'status' => 'in_progress',
                'progress' => 65,
                'time_remaining' => '2 weeks',
                'last_collaboration' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'title' => 'MailMaster',
                'description' => 'A Laravel-based email campaign manager with analytics and user lists.',
                'status' => 'not_started',
                'progress' => 0,
                'time_remaining' => '1 month',
                'last_collaboration' => null,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'VueDashboard',
                'description' => 'A modern SPA dashboard built with Vue.js and Tailwind CSS.',
                'status' => 'in_progress',
                'progress' => 40,
                'time_remaining' => '3 weeks',
                'last_collaboration' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'title' => 'DevPortfolio',
                'description' => 'A personal portfolio built with React and hosted on Vercel.',
                'status' => 'completed',
                'progress' => 100,
                'time_remaining' => null,
                'last_collaboration' => Carbon::now()->subWeeks(3),
                'created_at' => Carbon::now()->subMonths(1),
                'updated_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'title' => 'LaravelEcommerce',
                'description' => 'A full-featured ecommerce platform built with Laravel and Alpine.js.',
                'status' => 'in_progress',
                'progress' => 80,
                'time_remaining' => '1 week',
                'last_collaboration' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subWeeks(3),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}