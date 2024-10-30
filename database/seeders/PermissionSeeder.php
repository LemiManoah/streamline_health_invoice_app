<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PermissionCategory;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define categories and their permissions
        $categories = [
            'User Management' => [
                'create user',
                'update user',
                'edit users',
                'delete user',
                'view user',
            ],
            'Role Management' => [
                'view role',
                'update role',
                'edit role',
                'delete role',
                'create role',
                'Add / Edit Role Permission',
            ],
            'Permission Management' => [
                'view permission',
            ],
            'Client Management' => [
                'create clients',
                'view clients',
                'delete clients',
                'edit clients'
            ],
            
            'Invoice Management' => [
                'create invoice',
                'view invoice',
                'edit invoice',
                'delete invoice',
            ],
            'Subscription Management' => [
                'create subscription',
                'view subscription',
                'edit subscription',
                'delete subscription',
            ],
        ];

        foreach ($categories as $categoryName => $permissions) {
            // Create or get the category
            $category = PermissionCategory::firstOrCreate(['name' => $categoryName]);

            foreach ($permissions as $permissionName) {
                // Create permission with a category
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'permission_category_id' => $category->id, // Correct column name for the foreign key
                ]);
            }
        }

        // Role Permissions
        $roles = [
            'Super Admin' => array_merge(...array_values($categories)),
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}