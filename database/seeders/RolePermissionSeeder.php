<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        // =======================
        // Permission
        // =======================

        $permissions = [

            'dashboard.view',

            'pasien.view',
            'pasien.create',
            'pasien.edit',
            'pasien.delete',

            'dokter.view',
            'dokter.create',
            'dokter.edit',
            'dokter.delete',

            'jadwal.view',
            'jadwal.create',
            'jadwal.edit',
            'jadwal.delete',

            'antrian.view',
            'antrian.manage',

            'rekam-medis.view',
            'rekam-medis.create',
            'rekam-medis.delete',

            'profile.edit',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        // =======================
        // Role
        // =======================

        $admin = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $staff = Role::firstOrCreate([
            'name' => 'staff'
        ]);

        // =======================
        // Admin
        // =======================

        $admin->givePermissionTo(Permission::all());

        // =======================
        // Staff
        // =======================

        $staff->givePermissionTo([
            'dashboard.view',

            'pasien.view',
            'pasien.create',
            'pasien.edit',
            'pasien.delete',

            'jadwal.view',
            'jadwal.create',
            'jadwal.edit',

            'antrian.view',
            'antrian.manage',

            'rekam-medis.view',
            'rekam-medis.create',

            'profile.edit',
        ]);
    }
}