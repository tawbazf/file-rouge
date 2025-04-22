<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AssignmentSeeder extends Seeder
{
    public function run()
    {
        // Get the first user (as creator)
        $userId = DB::table('users')->value('id') ?? 1;

        DB::table('assignments')->insert([
            [
                'title' => 'Projet Laravel',
                'description' => 'Créer une application Laravel complète avec authentification.',
                'due_date' => Carbon::now()->addDays(14),
                'created_by' => $userId,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Analyse de Données',
                'description' => 'Réaliser une analyse de données avec Python et Pandas.',
                'due_date' => Carbon::now()->addDays(21),
                'created_by' => $userId,
                'status' => 'published',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Présentation Sécurité Web',
                'description' => 'Préparer une présentation sur la sécurité des applications web.',
                'due_date' => Carbon::now()->addDays(7),
                'created_by' => $userId,
                'status' => 'draft',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}