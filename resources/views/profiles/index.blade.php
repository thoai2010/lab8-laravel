@extends('layouts.app')

@section('title', 'Danh sách người dùng và hồ sơ')

@section('content')
<h2>Danh sách người dùng và thông tin hồ sơ</h2>
<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>STT</th>
      <th>Tên</th>
      <th>Email</th>
      <th>Địa chỉ</th>
      <th>Số điện thoại</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $u)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->profile->address ?? 'Chưa có' }}</td>
        <td>{{ $u->profile->phone ?? 'Chưa có' }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection