@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
  <div class="card-header">
    <h4>{{ $article->title }}</h4>
  </div>

  <div class="card-body">
    <p><strong>Tác giả:</strong> {{ $article->author }}</p>
    <p><strong>Ngày tạo:</strong> {{ $article->created_at->format('d/m/Y') }}</p>
    <p><strong>Nội dung:</strong></p>
    <p>{{ $article->content }}</p>

    @if($article->image)
      <div class="text-center mt-3">
        <img src="{{ asset('storage/' . $article->image) }}" alt="Ảnh bài viết"
             class="img-fluid rounded shadow-sm" style="max-width: 400px;">
      </div>
    @endif

    <div class="mt-3">
      <a href="{{ route('articles.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
    </div>
  </div>
</div>
@endsection
