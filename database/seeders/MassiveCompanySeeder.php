<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MassiveCompanySeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Configuration
        |--------------------------------------------------------------------------
        */

        $companyCount = 100;
        $candidateCount = 10_000;

        $jobsPerCompany = 10;
        $applicationsPerJob = 100;

        $chunkSize = 1_000;

        /*
        |--------------------------------------------------------------------------
        | 1. Get existing users
        |--------------------------------------------------------------------------
        |
        | We assume UserSeeder already created enough users.
        |
        | First 100 users  -> Company users
        | Next 10,000 users -> Candidate users
        |
        */

        $companyUserIds = DB::table('users')
            ->orderBy('id')
            ->limit($companyCount)
            ->pluck('id')
            ->toArray();

        if (count($companyUserIds) < $companyCount) {
            $this->command->error(
                "You need at least {$companyCount} users."
            );

            return;
        }

        $candidateUserIds = DB::table('users')
            ->orderBy('id')
            ->offset($companyCount)
            ->limit($candidateCount)
            ->pluck('id')
            ->toArray();

        if (count($candidateUserIds) < $candidateCount) {
            $this->command->error(
                "You need at least " .
                ($companyCount + $candidateCount) .
                " users."
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Create Candidate Profiles
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            "Creating {$candidateCount} candidate profiles..."
        );

        $profiles = [];

        foreach ($candidateUserIds as $index => $userId) {

            $number = $index + 1;

            $profiles[] = [
                'user_id' => $userId,
                'title' => 'Full Stack Developer',
                'bio' => 'Test candidate profile number ' . $number,
                'avatar' => null,
                'slug' => 'candidate-' . $userId,
                'country' => 'Morocco',
                'city' => 'Marrakech',
                'cv' => null,
                'is_completed' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($profiles) >= $chunkSize) {

                DB::table('candidate_profiles')
                    ->insert($profiles);

                $profiles = [];
            }
        }

        if (!empty($profiles)) {
            DB::table('candidate_profiles')
                ->insert($profiles);
        }

        $this->command->info(
            "{$candidateCount} candidate profiles created."
        );

        /*
        |--------------------------------------------------------------------------
        | 3. Create Companies
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            "Creating {$companyCount} companies..."
        );

        $companies = [];

        foreach ($companyUserIds as $index => $userId) {

            $number = $index + 1;

            $companies[] = [
                'user_id' => $userId,
                'logo' => null,
                'name' => 'Company ' . $number,
                'industry' => 'Technology',
                'size' => '51-200',
                'website' => 'https://company' . $number . '.com',
                'country' => 'Morocco',
                'city' => 'Marrakech',
                'description' => 'Test company number ' . $number,
                'is_completed' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (count($companies) >= $chunkSize) {

                DB::table('companies')
                    ->insert($companies);

                $companies = [];
            }
        }

        if (!empty($companies)) {
            DB::table('companies')
                ->insert($companies);
        }

        $this->command->info(
            "{$companyCount} companies created."
        );

        /*
        |--------------------------------------------------------------------------
        | 4. Create Jobs
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            'Creating jobs...'
        );

        $companyIds = DB::table('companies')
            ->orderBy('id')
            ->latest()
            ->limit($companyCount)
            ->pluck('id')
            ->reverse()
            ->values();

        $jobs = [];

        foreach ($companyIds as $companyIndex => $companyId) {

            for ($j = 1; $j <= $jobsPerCompany; $j++) {

                $jobs[] = [
                    'company_id' => $companyId,
                    'title' => 'Software Developer',
                    'description' =>
                        'Test job offer created for stress testing.',
                    'location' => 'Marrakech',
                    'contract_type' => 'full-time',
                    'work_mode' => 'hybrid',
                    'image' => 'jobs/default.jpg',
                    'is_closed' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if (count($jobs) >= $chunkSize) {

                    DB::table('job_offers')
                        ->insert($jobs);

                    $jobs = [];
                }
            }
        }

        if (!empty($jobs)) {
            DB::table('job_offers')
                ->insert($jobs);
        }

        $jobIds = DB::table('job_offers')
            ->orderBy('id')
            ->latest()
            ->limit($companyCount * $jobsPerCompany)
            ->pluck('id')
            ->reverse()
            ->values()
            ->toArray();

        $this->command->info(
            count($jobIds) . ' jobs created.'
        );

        /*
        |--------------------------------------------------------------------------
        | 5. Create Random Applications
        |--------------------------------------------------------------------------
        */

        $this->command->info(
            'Creating applications...'
        );

        $applications = [];

        $candidateTotal = count($candidateUserIds);

        foreach ($jobIds as $jobIndex => $jobId) {

            /*
            |--------------------------------------------------------------------------
            | Select 100 different candidates for this job
            |--------------------------------------------------------------------------
            |
            | array_rand() gives us random candidate indexes.
            |
            */

            $randomIndexes = array_rand(
                $candidateUserIds,
                $applicationsPerJob
            );

            /*
            | array_rand returns an integer if quantity = 1.
            | We have 100, so it returns an array.
            */

            foreach ($randomIndexes as $candidateIndex) {

                $candidateId =
                    $candidateUserIds[$candidateIndex];

                $applications[] = [
                    'user_id' => $candidateId,
                    'job_offer_id' => $jobId,
                    'status' => $this->randomStatus(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if (count($applications) >= $chunkSize) {

                    DB::table('applications')
                        ->insert($applications);

                    $applications = [];
                }
            }

            if (($jobIndex + 1) % 100 === 0) {

                $this->command->info(
                    'Jobs processed: ' .
                    ($jobIndex + 1) .
                    '/' .
                    count($jobIds)
                );
            }
        }

        if (!empty($applications)) {

            DB::table('applications')
                ->insert($applications);
        }

        /*
        |--------------------------------------------------------------------------
        | Finished
        |--------------------------------------------------------------------------
        */

        $this->command->info('');
        $this->command->info(
            '======================================'
        );
        $this->command->info(
            'STRESS TEST DATA CREATED'
        );
        $this->command->info(
            '======================================'
        );

        $this->command->info(
            'Company Users:       100'
        );

        $this->command->info(
            'Companies:            100'
        );

        $this->command->info(
            'Candidate Users:   10,000'
        );

        $this->command->info(
            'Candidate Profiles: 10,000'
        );

        $this->command->info(
            'Jobs:                1,000'
        );

        $this->command->info(
            'Applications:      100,000'
        );

        $this->command->info(
            '======================================'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Random Application Status
    |--------------------------------------------------------------------------
    */

    private function randomStatus(): string
    {
        $random = rand(1, 100);

        if ($random <= 70) {
            return 'pending';
        }

        if ($random <= 85) {
            return 'accepted';
        }

        return 'rejected';
    }
}