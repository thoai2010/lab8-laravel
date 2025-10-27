<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách
    public function index(Request $request)
    {
        $query = \App\Models\Product::query();

        // 🔍 Tìm kiếm
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 🔽 Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // ⚙️ Sắp xếp
        $sort = $request->get('sort', 'name'); // mặc định sắp theo tên
        $direction = $request->get('direction', 'asc'); // mặc định tăng dần

        if (!in_array($sort, ['name', 'price', 'stock'])) {
            $sort = 'name';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'asc';
        }

        $products = $query->orderBy($sort, $direction)
                        ->paginate(10)
                        ->withQueryString();

        $categories = \App\Models\Category::all();

        return view('products.index', compact('products', 'categories', 'sort', 'direction'));
    }

    // Form thêm mới
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->all();

        // Nếu có upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $data['image'] = $path;
        }

        Product::create($data);
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }


    // Form sửa
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $data = $request->all();

        // Nếu có upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ (nếu có)
            if ($product->image && file_exists(storage_path('app/public/'.$product->image))) {
                unlink(storage_path('app/public/'.$product->image));
            }

            $file = $request->file('image');
            $path = $file->store('images', 'public');
            $data['image'] = $path;
        }

        $product->update($data);
        return redirect()->route('products.index')->with('success', 'Cập nhật sản phẩm thành công!');
    }


    // Xóa sản phẩm
    public function destroy(Product $product)
    {
        if ($product->image && file_exists(storage_path('app/public/'.$product->image))) {
            unlink(storage_path('app/public/'.$product->image));
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Đã xóa sản phẩm!');
    }

}
