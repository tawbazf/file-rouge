<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    public function run()
    {
        $skills = [
            ['name' => 'HTML'],
            ['name' => 'CSS'],
            ['name' => 'JavaScript'],
            ['name' => 'PHP'],
            ['name' => 'Laravel'],
            ['name' => 'SQL'],
            ['name' => 'Git'],
            ['name' => 'Python'],
            ['name' => 'Communication'],
            ['name' => 'Résolution de problèmes'],
        ];

        DB::table('skills')->insert($skills);
    }
}