@extends('layouts.app')

@section('title', 'Thêm sản phẩm')

@section('content')
<h2>Thêm sản phẩm mới</h2>

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('products.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Tên sản phẩm</label>
    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
  </div>
  <div class="mb-3">
    <label>Giá</label>
    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
  </div>
  <div class="mb-3">
    <label>Tồn kho</label>
    <input type="number" name="stock" class="form-control" value="{{ old('stock', 0) }}">
  </div>
  <div class="mb-3">
    <label>Danh mục</label>
    <select name="category_id" class="form-control">
      <option value="">-- Chọn danh mục --</option>
      @foreach($categories as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success">Lưu</button>
  <a href="{{ route('products.index') }}" class="btn btn-secondary">Hủy</a>
</form>
@endsection
