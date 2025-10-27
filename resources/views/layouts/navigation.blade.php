<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
  <div class="container">
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

          {{-- Khu quản trị chỉ admin được vào --}}
          @if(Auth::user()->role === 'admin')
            <li class="nav-item">
              <a class="nav-link text-warning" href="{{ url('/admin/articles') }}">Khu quản trị</a>
            </li>
          @endif

          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-light ms-2">Đăng xuất</button>
            </form>
          </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
