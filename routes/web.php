<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\ArticleController;

// Trang chủ
Route::get('/', function () {
    return view('welcome');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Hồ sơ người dùng (tự động sinh từ Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// CRUD Sản phẩm, Sinh viên, Hồ sơ
Route::resource('products', ProductController::class);
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');

// Các truy vấn tổng hợp
Route::get('/queries/expensive', [QueryController::class, 'expensiveProducts'])->name('queries.expensive');
Route::get('/queries/category-count', [QueryController::class, 'categoryProductCount'])->name('queries.category_count');
Route::get('/queries/student-course', [QueryController::class, 'studentCourseCount'])->name('queries.student_course');

// Bài viết (Lab 9 - bài 5 & 6)
Route::middleware('auth')->group(function () {
    // Người dùng thường chỉ xem
    Route::resource('articles', ArticleController::class)->only(['index', 'show']);

    // Quản trị (admin) được CRUD đầy đủ
    Route::middleware('admin')->prefix('admin')->group(function () {
        Route::resource('articles', ArticleController::class)->except(['index', 'show']);
    });
});

require __DIR__ . '/auth.php';
