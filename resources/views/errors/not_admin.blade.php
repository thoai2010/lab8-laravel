@extends('layouts.app')

@section('content')
<div class="container text-center mt-5">
    <h2 class="text-danger fw-bold">⛔ Truy cập bị chặn!</h2>
    <p>Bạn không có quyền truy cập khu vực quản trị.</p>
    <a href="{{ url('/set-admin') }}" class="btn btn-primary mt-3">Trở thành admin</a>
</div>
@endsection
