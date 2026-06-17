<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $skills = [
        'Laravel',
        'React',
        'Vue.js',
        'MySQL',
        'MongoDB',
        'Node.js',
        'Express.js',
        'JavaScript',
        'TypeScript',
        'PHP',
        'Python',
        'Docker',
        'Git',
        'Linux',
    ];

    foreach ($skills as $skill) {
        Skill::create([
            'name' => $skill
        ]);
    }
}
}
