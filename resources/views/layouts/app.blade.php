<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">

            <a class="logo" href="#">
                CineGo
            </a>

            <div class="d-flex align-items-center ms-4">
                <a href="#" class="nav-link-custom">Phim</a>
                <a href="#" class="nav-link-custom">Rạp</a>
                <a href="#" class="nav-link-custom">Vé của tôi</a>
            </div>

            <div class="mx-auto">
                <input
                    type="text"
                    class="search-box"
                    placeholder="Tìm kiếm phim,tác giả ..."
                >
            </div>

            <div class="d-flex align-items-center">
                <a href="#" class="nav-link-custom">Ngôn ngữ</a>
                <a href="{{ route('login') }}" class="nav-link-custom">Đăng ký/Đăng nhập</a>
                <button class="btn btn-secondary download-btn ms-3">
                    Tải xuống app
                </button>
            </div>

        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>