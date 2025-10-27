@extends('layouts.app')

@section('content')
<div class="card">
  <div class="card-header">
    <h4>Danh sách hồ sơ người dùng</h4>
  </div>
  <div class="card-body">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Tên</th>
          <th>Email</th>
          <th>Giới tính</th>
          <th>Ngày sinh</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $u)
          <tr>
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->profile->gender ?? 'Chưa có' }}</td>
            <td>{{ $u->profile->birthday ?? 'Chưa có' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="mt-3">
      {{ $users->links() }}
    </div>
  </div>
</div>
@endsection
