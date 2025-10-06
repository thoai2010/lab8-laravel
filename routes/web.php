<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');

use App\Http\Controllers\QueryController;

Route::get('/queries/expensive', [QueryController::class, 'expensiveProducts'])->name('queries.expensive');
Route::get('/queries/category-count', [QueryController::class, 'categoryProductCount'])->name('queries.category_count');
Route::get('/queries/student-course', [QueryController::class, 'studentCourseCount'])->name('queries.student_course');
