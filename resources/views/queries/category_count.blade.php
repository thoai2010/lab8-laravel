@extends('layouts.app')

@section('title', 'Số lượng sản phẩm theo danh mục')

@section('content')
<h2>Số lượng sản phẩm theo danh mục</h2>
<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>Danh mục</th>
      <th>Số sản phẩm</th>
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $c)
      <tr>
        <td>{{ $c->name }}</td>
        <td>{{ $c->products_count }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
