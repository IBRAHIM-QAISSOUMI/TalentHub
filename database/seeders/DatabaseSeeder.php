<?php

namespace Database\Seeders;
use Database\Seeders\SkillSeeder;
use Database\Seeders\RolePermissionSeeder;
use App\Models\CandidateProfile;
use App\Models\User;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SkillSeeder::class,
    ]);

        $this->call([
            RolePermissionSeeder::class,
    ]);
        User::factory(20)
            ->has(
                CandidateProfile::factory()
                    ->has(Experience::factory(2), 'experiences')
                    ->has(Education::factory(2), 'educations')
                ,
                'candidateProfile'
            )
            ->create()
            ->each(function ($user) {

                $user->assignRole('candidate');

                $profile = $user->candidateProfile;

                $skills = Skill::inRandomOrder()
                    ->take(3)
                    ->pluck('id');

                $profile->skills()->attach($skills);
            });
    }
}
