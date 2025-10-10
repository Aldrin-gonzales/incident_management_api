<?php

namespace Database\Seeders;

use App\Models\Incident;
use Illuminate\Database\Seeder;

class IncidentSeeder extends Seeder
{
         public function run(): void 
         {
           // this is to create 10 random incidents
          Incident::factory()->count(10)->create();
         }
}