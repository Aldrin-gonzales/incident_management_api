<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'first_name' => 'Test',
                'last_name' => 'User',
                'role' => 'admin',
                'mobile_number' => '0000000000',
                'age' => 30,
                'address' => 'N/A',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->call([
            UserSeeder::class,
            IncidentTypeSeeder::class,
            IncidentSeeder::class,
            AccessTokenSeeder::class,
        ]);
    }
}
