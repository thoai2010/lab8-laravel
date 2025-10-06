@extends('layouts.app')

@section('title', 'Sản phẩm có giá > 100.000')

@section('content')
<h2>Danh sách sản phẩm có giá &gt; 100.000</h2>
<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>Tên</th>
      <th>Giá</th>
      <th>Tồn kho</th>
      <th>Danh mục</th>
    </tr>
  </thead>
  <tbody>
    @foreach($products as $p)
      <tr>
        <td>{{ $p->name }}</td>
        <td>{{ number_format($p->price) }} đ</td>
        <td>{{ $p->stock }}</td>
        <td>{{ $p->category->name ?? 'Chưa có' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
