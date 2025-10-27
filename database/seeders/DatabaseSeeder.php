<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // ✅ Thêm dòng này
use App\Models\Category;
use App\Models\Product;
use App\Models\Student;
use App\Models\Course;
use App\Models\User;
use App\Models\Profile;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Category::factory(5)
            ->has(Product::factory()->count(10))
            ->create();

        $students = Student::factory(10)->create();
        $courses = Course::factory(5)->create();

        foreach ($students as $student) {
            $student->courses()->attach(
                $courses->random(rand(1, 3))->pluck('id')->toArray()
            );
        }

        User::factory(5)->create()->each(function ($user) {
            Profile::factory()->create(['user_id' => $user->id]);
        });

        Article::factory(10)->create();

        $this->command->info('Database đã seed thành công toàn bộ dữ liệu mẫu!');
        $this->call(UserSeeder::class);

        // ✅ Tạo admin
        User::updateOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // ✅ Tạo user thường
        User::updateOrCreate([
            'email' => 'user@example.com',
        ], [
            'name' => 'User',
            'password' => Hash::make('123456'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
