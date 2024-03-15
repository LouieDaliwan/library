<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Superadmin' => [
                'can-create-libraries',
                'can-create-books',
                'can-edit-libraries',
                'can-edit-books',
                'can-delete-libraries',
                'can-delete-books',
                'can-view'
            ],
            'Member' => [
                'can-view',
                'can-book-borrow',
            ]
        ];

        foreach ($roles as $role => $permissions) {
            $role = Role::firstOrCreate(['name' => $role]);
            foreach ($permissions as $permission) {
                Permission::firstOrCreate(['name' => $permission]);

                $role->givePermissionTo($permission);
            }
        }
    }
}
