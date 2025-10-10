<?php

namespace Database\Seeders;

use App\Models\IncidentType;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Fire Emergency(Sunog)',
                'description' => 'Incidents involving fire breakouts or smoke sightings.',
            ],
            [
                'name' => 'Medical Emergency',
                'description' => 'Injuries, illnesses, or medical-related incidents requiring assistance.',
            ],
            [
                'name' => 'Natural Disaster',
                'description' => 'Floods, earthquakes, typhoons, and other weather-related incidents.',
            ],
            [
                'name' => 'Vehicular Accident',
                'description' => '2 or more Vehicle collisions or breakdowns, or collision with person.',
            ],
            [
                'name' => 'Power Outage',
                'description' => 'Loss of electrical power in an area or facility.',
            ],
            [
                'name' => 'Public Disturbance',
                'description' => 'Riots, protests, or large gatherings causing disruption.',
            ],
            [ 
                'name' => 'Other',
                'description' => 'Incidents that do not fit into the predefined categories.',
            ],
        ];

        foreach ($types as $type) {
            IncidentType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }
    }
}
