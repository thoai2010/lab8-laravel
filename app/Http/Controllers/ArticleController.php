<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Hiển thị danh sách bài viết
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('articles.index', compact('articles'));
    }

    // Hiển thị form tạo bài viết
    public function create()
    {
        return view('articles.create');
    }

    // Lưu bài viết mới
    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        // ✅ Laravel 9+ IDE friendly upload
        if ($request->hasFile('image')) {
            /** @var \Illuminate\Http\UploadedFile $file */
            $file = $request->file('image');
            $path = $file->store('articles', 'public'); // IDE không còn báo lỗi
            $data['image'] = $path;
        }

        $data['author'] = Auth::user()->name ?? 'Khách';
        Article::create($data);

        return redirect()->route('articles.index')->with('success', 'Thêm bài viết thành công!');
    }

    // Hiển thị chi tiết
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // Hiển thị form chỉnh sửa
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    // Cập nhật bài viết
    public function update(StoreArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            /** @var \Illuminate\Http\UploadedFile $file */
            $file = $request->file('image');
            $path = $file->store('articles', 'public');
            $data['image'] = $path;
        }

        $article->update($data);

        return redirect()->route('articles.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    // Xóa bài viết
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Đã xóa bài viết!');
    }
}
