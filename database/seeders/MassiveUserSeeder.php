<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MassiveUserSeeder extends Seeder
{
    public function run(): void
    {
        $companyUsers = 100;
        $candidateUsers = 10_000;

        $password = Hash::make('password');

        /*
        |--------------------------------------------------------------------------
        | Company / Recruiter Users
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            "Creating {$companyUsers} recruiter users..."
        );

        for ($i = 1; $i <= $companyUsers; $i++) {

            $user = User::create([
                'name' => 'Recruiter ' . $i,
                'email' => 'recruiter' . $i . '@example.com',
                'email_verified_at' => now(),
                'password' => $password,
                'remember_token' => null,
            ]);

            $user->assignRole('recruiter');
        }

        $this->command->info(
            "{$companyUsers} recruiter users created."
        );

        /*
        |--------------------------------------------------------------------------
        | Candidate Users
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            "Creating {$candidateUsers} candidate users..."
        );

        for ($i = 1; $i <= $candidateUsers; $i++) {

            $user = User::create([
                'name' => 'Candidate ' . $i,
                'email' => 'candidate' . $i . '@example.com',
                'email_verified_at' => now(),
                'password' => $password,
                'remember_token' => null,
            ]);

            $user->assignRole('candidate');

            if ($i % 1000 === 0) {
                $this->command->info(
                    "Candidates created: {$i}/{$candidateUsers}"
                );
            }
        }

        $this->command->info(
            "{$candidateUsers} candidate users created."
        );

        /*
        |--------------------------------------------------------------------------
        | Summary
        |--------------------------------------------------------------------------
        */

        $this->command->info('');
        $this->command->info(
            '======================================'
        );
        $this->command->info(
            'USERS CREATED'
        );
        $this->command->info(
            '======================================'
        );
        $this->command->info(
            'Recruiters:  ' . $companyUsers
        );
        $this->command->info(
            'Candidates:  ' . $candidateUsers
        );
        $this->command->info(
            'Total:       ' . ($companyUsers + $candidateUsers)
        );
        $this->command->info(
            '======================================'
        );
    }
}