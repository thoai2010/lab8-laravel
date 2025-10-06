<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Lab 8')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    {{-- Thanh menu --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Trang chủ</a>
            <div>
                <a class="nav-link d-inline text-light" href="{{ route('products.index') }}">Products</a>
                <a class="nav-link d-inline text-light" href="{{ url('/students') }}">Students</a>
                <a class="nav-link d-inline text-light" href="{{ route('profiles.index') }}">Profiles</a>
            </div>
        </div>
    </nav>

    {{-- Nội dung trang --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="text-center mt-4 py-3 text-muted border-top">
        © HUIT – Khoa CNTT. Laravel 12 Lab.
    </footer>

    <style>
        nav[role="navigation"] {
            display: flex;
            justify-content: center;
        }
    </style>
</body>
</html>
