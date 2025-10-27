
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Lab9 Project') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

{{-- Thanh điều hướng --}}
@include('layouts.navigation')

<div class="container py-4">
  <a class="navbar-brand" href="{{ url('/') }}">Lab9</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav me-auto">
        @auth
          <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Sản phẩm</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('students.index') }}">Sinh viên</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('profiles.index') }}">Hồ sơ</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('articles.index') }}">Bài viết</a></li>
        @endauth
      </ul>

      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Đăng nhập</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Đăng ký</a></li>
        @endguest

        @auth
          <li class="nav-item">
            <span class="navbar-text text-white me-3">
              Xin chào, <strong>{{ Auth::user()->name }}</strong>
              ({{ Auth::user()->role }})
            </span>
          </li>

          @if(Auth::user()->role === 'admin')
            <li class="nav-item"><a class="nav-link text-warning" href="{{ url('/admin/articles') }}">Khu quản trị</a></li>
          @endif

          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-light">Đăng xuất</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
