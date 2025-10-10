<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'first_name'      => $this->faker->firstName(),
            'last_name'       => $this->faker->lastName(),
            'email'           => $this->faker->unique()->safeEmail(),
            'password'        => Hash::make('password'),
            'mobile_number'   => $this->faker->numerify('09#########'),
            'age'             => $this->faker->numberBetween(18, 60),
            'address'         => $this->faker->address(),
            'role'            => $this->faker->randomElement(['admin', 'user']),
            'profile_picture' => null,
        ];
    }

}