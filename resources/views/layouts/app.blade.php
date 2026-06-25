<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/movie.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/ticket.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/booking.css') }}">
    <link rel="stylesheet" href="{{ asset('css/page/seat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/account.css') }}">
    <link rel="stylesheet" href="{{ asset('css/user/about.css') }}">
</head>
<body>
    {{-- @php
        use Illuminate\Support\Facades\Auth;
        use App\Models\User;
        Auth::login(User::first()); // Automatically log in the first user for testing purposes
    @endphp --}}
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="logo" href="{{ route('movies') }}">
                CineGo
            </a>

            <div class="d-flex align-items-center ms-4">
                <a href="{{ route('movies') }}" class="nav-link-custom">Phim</a>
                <a href="{{ route('user.help.about') }}" class="nav-link-custom">Rạp</a>
                @auth
                    <a href="{{ route('user.account.tickets') }}" class="nav-link-custom">Vé của tôi</a>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="nav-link-custom">Vé của tôi</a>
                @endguest
            </div>
            <div class="mx-auto">
                <input
                    type="text"
                    class="search-box"
                    placeholder="Tìm kiếm phim,tác giả ..."
                >
            </div>

            <div class="d-flex align-items-center">
                @auth
                <div class="dropdown">
                    <a
                        class="nav-link-custom dropdown-toggle"
                        data-bs-toggle="dropdown"
                        href="#">
                        {{ Auth::user()->full_name }}
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item"
                            href="{{ route('user.account.general') }}">
                                Tài khoản
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                            href="{{ route('user.account.tickets') }}">
                                Vé của tôi
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                           
                                <button>
                                    Đăng xuất                                 
                                </button>

                        </li>

                    </ul>

                </div>

                @endauth
                @guest
                    <a href="{{ route('login') }}" class="nav-link-custom">Đăng nhập</a>
                    <a href="{{ route('register') }}" class="nav-link-custom">Đăng ký</a>
                @endguest
            </div>

        </div>
    </nav>

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (confirm(@json(session('error')))) {
                    // window.location.href = "{{ route('movies') }}";
                }
            });
        </script>
@endif
</body>

</html>