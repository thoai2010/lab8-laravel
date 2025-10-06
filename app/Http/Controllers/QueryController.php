<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Student;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    // 1. Sản phẩm có giá > 100000
    public function expensiveProducts()
    {
        $products = Product::where('price', '>', 100000)->get();
        return view('queries.expensive', compact('products'));
    }

    // 2. Đếm số sản phẩm mỗi danh mục
    public function categoryProductCount()
    {
        $categories = Category::withCount('products')->get();
        return view('queries.category_count', compact('categories'));
    }

    // 3. Danh sách sinh viên + số lượng môn học
    public function studentCourseCount()
    {
        $students = Student::withCount('courses')->get();
        return view('queries.student_course', compact('students'));
    }
}
