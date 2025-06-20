<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin'
        ]);

        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Outlet Incharges
        User::create([
            'name' => 'Main Outlet Manager',
            'email' => 'main@example.com',
            'password' => Hash::make('password'),
            'role' => 'outlet_incharge',
            'outlet_id' => 1
        ]);

        User::create([
            'name' => 'North Outlet Manager',
            'email' => 'north@example.com',
            'password' => Hash::make('password'),
            'role' => 'outlet_incharge',
            'outlet_id' => 2
        ]);
    }
}
