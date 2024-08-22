<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $permissions = [
        'create user',
        'update user',
        'edit users',
        'delete user',
        'view user',
        'view role',
        'update role',
        'edit role',
        'delete role',
        'create role',
        'view permission',
        'Add / Edit Role Permission',

        
      ];

      foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
      }

      $roles = [
        'Super Admin' => [
            'create user',
            'update user',
            'edit users',
            'delete user',
            'view user',
            'view role',
            'update role',
            'edit role',
            'delete role',
            'create role',
            'view permission',
            'Add / Edit Role Permission',

        ]
      ];

      foreach ($roles as $roleName => $permissions) {
        $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => $roleName]);
        $role->syncPermissions($permissions);
      }

    }
}
