@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4>✏️ Chỉnh sửa bài viết</h4>
  </div>

  <div class="card-body">
    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="title" class="form-label">Tiêu đề</label>
        <input type="text" name="title" id="title" class="form-control"
               value="{{ old('title', $article->title) }}" required>
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label for="author" class="form-label">Tác giả</label>
        <input type="text" name="author" id="author" class="form-control"
               value="{{ old('author', $article->author) }}" required>
        @error('author') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label for="content" class="form-label">Nội dung</label>
        <textarea name="content" id="content" rows="5" class="form-control" required>{{ old('content', $article->content) }}</textarea>
        @error('content') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label for="image" class="form-label">Ảnh minh họa (tuỳ chọn)</label>
        <input type="file" name="image" id="image" class="form-control">
        @if($article->image)
          <div class="mt-2">
            <p>Ảnh hiện tại:</p>
            <img src="{{ asset('storage/' . $article->image) }}" alt="Ảnh bài viết" class="img-fluid rounded" style="max-width: 200px;">
          </div>
        @endif
      </div>

      <div class="d-flex justify-content-between">
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">← Quay lại</a>
        <button type="submit" class="btn btn-primary">💾 Cập nhật</button>
      </div>
    </form>
  </div>
</div>
@endsection
