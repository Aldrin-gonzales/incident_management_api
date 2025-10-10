<?php

namespace Database\Seeders;

use App\Models\IncidentType;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Create 7 random incident types
        IncidentType::factory()->count(7)->create();
    }
}
