@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

@section('content')
<h2>Danh sách sản phẩm</h2>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Thêm sản phẩm</a>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
  <tr>
    <th>Ảnh</th>
    <th>Tên</th>
    <th>Giá</th>
    <th>Tồn kho</th>
    <th>Danh mục</th>
    <th>Hành động</th>
  </tr>
</thead>
    <tbody>
    @foreach($products as $p)
        <tr>
        <td>
            @if($p->image)
            <img src="{{ asset('storage/'.$p->image) }}" width="60" height="60">
            @else
            <span class="text-muted">Chưa có</span>
            @endif
        </td>
        <td>{{ $p->name }}</td>
        <td>{{ number_format($p->price) }} đ</td>
        <td>{{ $p->stock }}</td>
        <td>{{ $p->category->name ?? 'Chưa có' }}</td>
        <td>
            <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm">Sửa</a>
            <form action="{{ route('products.destroy', $p->id) }}" method="POST" style="display:inline-block">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Xóa sản phẩm này?')" class="btn btn-danger btn-sm">Xóa</button>
            </form>
        </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $products->links() }}
@endsection
