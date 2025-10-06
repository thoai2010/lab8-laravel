<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 5 user kèm profile
        User::factory()->count(5)->create()->each(function ($user) {
            $user->profile()->create([
                'address' => fake()->address(),
                'phone'   => fake()->phoneNumber(),
            ]);
        });
    }
}
