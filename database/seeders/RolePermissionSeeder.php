<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // PERMISSIONS
        // =====================

        $permissions = [
            // Admin
            'manage users',
            'view users',
            'delete users',
            'ban users',
            'manage roles',
            'manage permissions',

            // Recruiter
            'create jobs',
            'edit jobs',
            'delete jobs',
            'view own jobs',
            'publish jobs',
            'close jobs',
            'view applications',
            'accept applications',
            'reject applications',

            // Candidate
            'view jobs',
            'apply jobs',
            'withdraw application',
            'view own applications',
            'update profile',
            'upload resume',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // =====================
        // ROLES
        // =====================

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $recruiter = Role::firstOrCreate(['name' => 'recruiter']);
        $candidate = Role::firstOrCreate(['name' => 'candidate']);

        // =====================
        // ASSIGN PERMISSIONS
        // =====================

        $admin->givePermissionTo(Permission::all());

        $recruiter->givePermissionTo([
            'create jobs',
            'edit jobs',
            'delete jobs',
            'view own jobs',
            'publish jobs',
            'close jobs',
            'view applications',
            'accept applications',
            'reject applications',
        ]);

        $candidate->givePermissionTo([
            'view jobs',
            'apply jobs',
            'withdraw application',
            'view own applications',
            'update profile',
            'upload resume',
        ]);
    }
}