@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h4 class="mb-0">Danh sách bài viết</h4>
    @if(Auth::check() && Auth::user()->role === 'admin')
      <a href="{{ route('articles.create') }}" class="btn btn-primary btn-sm">+ Thêm mới</a>
    @endif
  </div>

  <div class="card-body">
    <table class="table table-hover align-middle">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Tiêu đề</th>
          <th>Tác giả</th>
          <th>Ngày tạo</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($articles as $a)
          <tr>
            <td>{{ $a->id }}</td>
            <td>
              <a href="{{ route('articles.show', $a->id) }}">{{ $a->title }}</a>
            </td>
            <td>{{ $a->author }}</td>
            <td>{{ $a->created_at->format('d/m/Y') }}</td>
            <td>
              @if(Auth::check() && Auth::user()->role === 'admin')
                <a href="{{ route('articles.edit', $a->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                <form action="{{ route('articles.destroy', $a->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Xóa bài viết này?')">
                    Xóa
                  </button>
                </form>
              @endif
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-3">
      {{ $articles->links() }}
    </div>
  </div>
</div>
@endsection
