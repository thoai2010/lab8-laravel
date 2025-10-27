@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
<div class="container mt-4">
  <h2 class="mb-3">Danh sách sản phẩm</h2>

  {{-- Form tìm kiếm và lọc --}}
  <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-3">
    <div class="col-md-4">
      <input type="text" name="keyword" value="{{ request('keyword') }}" class="form-control" placeholder="Nhập tên sản phẩm...">
    </div>
    <div class="col-md-3">
      <select name="category_id" class="form-select">
        <option value="">-- Tất cả danh mục --</option>
        @foreach($categories as $c)
          <option value="{{ $c->id }}" {{ request('category_id') == $c->id ? 'selected' : '' }}>
            {{ $c->name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <button class="btn btn-secondary w-100">Tìm kiếm</button>
    </div>
  </form>

  {{-- Nút thêm sản phẩm --}}
  @if(Auth::check() && Auth::user()->role === 'admin')
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Thêm sản phẩm</a>
  @endif

  <table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
      <tr>
        {{-- Các cột có thể bấm để sắp xếp --}}
        <th>
          <a href="{{ route('products.index', ['sort' => 'name', 'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'] + request()->except('page')) }}" class="text-white text-decoration-none">
            Tên
            @if($sort === 'name')
              {!! $direction === 'asc' ? '↑' : '↓' !!}
            @endif
          </a>
        </th>
        <th>
          <a href="{{ route('products.index', ['sort' => 'price', 'direction' => $sort === 'price' && $direction === 'asc' ? 'desc' : 'asc'] + request()->except('page')) }}" class="text-white text-decoration-none">
            Giá
            @if($sort === 'price')
              {!! $direction === 'asc' ? '↑' : '↓' !!}
            @endif
          </a>
        </th>
        <th>
          <a href="{{ route('products.index', ['sort' => 'stock', 'direction' => $sort === 'stock' && $direction === 'asc' ? 'desc' : 'asc'] + request()->except('page')) }}" class="text-white text-decoration-none">
            Tồn kho
            @if($sort === 'stock')
              {!! $direction === 'asc' ? '↑' : '↓' !!}
            @endif
          </a>
        </th>
        <th>Danh mục</th>
        @if(Auth::check() && Auth::user()->role === 'admin')
          <th>Hành động</th>
        @endif
      </tr>
    </thead>

    <tbody>
      @forelse($products as $p)
        <tr>
          <td>{{ $p->name }}</td>
          <td>{{ number_format($p->price) }} đ</td>
          <td>{{ $p->stock }}</td>
          <td>{{ $p->category->name ?? 'Chưa có' }}</td>

          @if(Auth::check() && Auth::user()->role === 'admin')
            <td>
              <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm">Sửa</a>
              <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline-block">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Xóa sản phẩm này?')" class="btn btn-danger btn-sm">Xóa</button>
              </form>
            </td>
          @endif
        </tr>
      @empty
        <tr><td colspan="5" class="text-center text-muted">Không tìm thấy sản phẩm</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-3">
    {{ $products->links() }}
  </div>
</div>
@endsection
