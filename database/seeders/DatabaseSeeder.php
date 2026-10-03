<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Skills + Roles
        |--------------------------------------------------------------------------
        */

        $this->call([
            SkillSeeder::class,
            RolePermissionSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        $this->call([
            MassiveUserSeeder::class,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Companies + Profiles + Jobs + Applications
        |--------------------------------------------------------------------------
        */

        $this->call([
            MassiveCompanySeeder::class,
        ]);
    }
}