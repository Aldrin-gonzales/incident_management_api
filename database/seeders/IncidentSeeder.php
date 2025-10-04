<?php

namespace Database\Seeders;

use App\Models\Incident;
use Illuminate\Database\Seeder;

class IncidentSeeder extends Seeder
{
         public function run(): void {
          Incident::create([
            'description' => 'Incident 1',
            'status' => 'reported',
            'incident_type_id' => 1,
            'reported_by' => 1,
          ]);
         }
}