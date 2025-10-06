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
