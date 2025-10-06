@extends('layouts.app')

@section('title', 'Số môn học mỗi sinh viên')

@section('content')
<h2>Danh sách sinh viên và số lượng môn học đăng ký</h2>
<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>STT</th>
      <th>Họ tên</th>
      <th>Email</th>
      <th>Số môn học</th>
    </tr>
  </thead>
  <tbody>
    @foreach($students as $s)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $s->name }}</td>
        <td>{{ $s->email }}</td>
        <td>{{ $s->courses_count }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
