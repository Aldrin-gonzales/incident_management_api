<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class IncidentTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Fire Emergency(Sunog)',
                'Medical Emergency',
                'Natural Disaster',
                'Vehicular Accident',
                'Power Outage',
                'Public Disturbance',
                'Other',
            ]),
            'description' => $this->faker->sentence(8),
        ];
    }
}
