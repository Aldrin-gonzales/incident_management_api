<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AccessTokenSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command?->warn('No users available for access token generation.');

            return;
        }

        foreach ($users as $user) {
            $user->tokens()->delete();

            $token = $user->createToken('seeded-token');
            $plainTextToken = $token->plainTextToken;

            $this->command?->info(sprintf('Token for %s: %s', $user->email, $plainTextToken));
        }
    }
}
