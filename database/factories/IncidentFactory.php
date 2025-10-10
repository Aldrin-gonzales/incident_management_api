<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\IncidentType;
use App\Models\User;


class IncidentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'description'        => $this->faker->sentence(6),
            'status'             => $this->faker->randomElement(['reported', 'in_progress', 'resolved']),
            'incident_type_id'   => IncidentType::inRandomOrder()->first()?->id ?? 1,
            'reported_by'        => User::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
