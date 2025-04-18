<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;

class BadgesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('badges')->insert([
            [
                'name' => 'Débutant',
                'description' => 'A complété son premier projet.',
                'image_path' => 'badges/debutant.png',
                'category' => 'Projet',
                'level' => 'Bronze',
                'points_required' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Intermédiaire',
                'description' => 'A complété 5 projets.',
                'image_path' => 'badges/intermediaire.png',
                'category' => 'Projet',
                'level' => 'Argent',
                'points_required' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Expert',
                'description' => 'A complété 10 projets.',
                'image_path' => 'badges/expert.png',
                'category' => 'Projet',
                'level' => 'Or',
                'points_required' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Code Reviewer',
                'description' => 'A relu 10 PRs.',
                'image_path' => 'badges/reviewer.png',
                'category' => 'Collaboration',
                'level' => 'Bronze',
                'points_required' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Apprenant Assidu',
                'description' => 'A suivi 5 cours.',
                'image_path' => 'badges/assidu.png',
                'category' => 'Cours',
                'level' => 'Argent',
                'points_required' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}