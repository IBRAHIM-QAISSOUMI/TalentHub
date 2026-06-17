<?php

namespace Database\Seeders;
use Database\Seeders\SkillSeeder;
use Database\Seeders\RolePermissionSeeder;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
    }
}
