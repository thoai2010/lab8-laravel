<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'address' => fake()->address(),
            'phone'   => fake()->phoneNumber(),
            'user_id' => null,
        ];
    }
}
