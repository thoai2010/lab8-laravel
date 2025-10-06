@extends('layouts.app')

@section('title', 'Danh sách sinh viên')

@section('content')
<h2>Danh sách sinh viên và các môn học đã đăng ký</h2>
<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>STT</th>
      <th>Họ tên</th>
      <th>Email</th>
      <th>Môn học</th>
    </tr>
  </thead>
  <tbody>
    @foreach($students as $s)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $s->name }}</td>
        <td>{{ $s->email }}</td>
        <td>
          @foreach($s->courses as $c)
            <span>{{ $c->title }}</span>@if(!$loop->last), @endif
          @endforeach
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
