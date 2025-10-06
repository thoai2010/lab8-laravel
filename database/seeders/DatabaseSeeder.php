<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()
            ->count(5)
            ->hasProducts(10)
            ->create();
        $this->call(StudentCourseSeeder::class);
        $this->call(ProfileSeeder::class);
    }
}