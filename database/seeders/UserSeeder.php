<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Lemi',
                'email' => 'lemi@gmail.com',
                'password' => bcrypt('Lemi@123'),
                'roles' => 'Super Admin', // Role to assign
            ]
        ];

        foreach ($users as $userData) {
            // Create or find the user
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => $userData['password'],
                ]
            );

            // Create or find the role
            $role = Role::firstOrCreate(['name' => $userData['roles']]);

            // Assign role to the user
            $user->assignRole($role);
        }
    }
}
