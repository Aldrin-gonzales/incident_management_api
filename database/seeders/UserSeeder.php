<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'John Lloyd',
                'last_name' => 'Gracilla',
                'email' => 'johnlloyd@example.com',
                'password' => Hash::make('password'),
                'mobile_number' => '09123456789',
                'age' => 21,
                'address' => 'Fabrica Bulan Sorsogon',
                'role' => 'admin',
                'profile_picture' => null,
            ],
            [
                'first_name' => 'Aldrin',
                'last_name' => 'Gonzales',
                'email' => 'aldrin@example.com',
                'password' => Hash::make('password'),
                'mobile_number' => '09123456788',
                'age' => 28,
                'address' => 'San Juan Daan Bulan Sorsogon',
                'role' => 'patient',
                'profile_picture' => null,
            ],
            [
                'first_name' => 'Rustom',
                'last_name' => 'Gracilla',
                'email' => 'rustom@example.com',
                'password' => Hash::make('password'),
                'mobile_number' => '09123456787',
                'age' => 34,
                'address' => 'Pawa Bulan Sorsogon',
                'role' => 'patient',
                'profile_picture' => null,
            ],
            [
                'first_name' => 'Marlon',
                'last_name' => 'Bonong',
                'email' => 'marlon@example.com',
                'password' => Hash::make('password'),
                'mobile_number' => '09123456786',
                'age' => 34,
                'address' => 'Obrero Bulan Sorsogon',
                'role' => 'patient',
                'profile_picture' => null,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
