<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết lịch chiếu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0b1220;
            color: #f8fafc;
        }

        .sidebar {
            min-height: 100vh;
            background: #0f172a;
            border-right: 1px solid #1f2937;
        }

        .sidebar .nav-link {
            color: #94a3b8;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #f8fafc;
            background: rgba(14,165,233,0.12);
        }

        .card {
            background: #111827;
            border: 1px solid #1f2937;
        }

        .info-label {
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: #f8fafc;
        }

        .poster {
            max-width: 220px;
            border-radius: 12px;
            border: 1px solid #334155;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <aside class="col-lg-2 sidebar p-3">
            <div class="mb-4 text-white">
                <h5 class="mb-1">CineGo Admin</h5>
                <small class="text-muted">Chi tiết lịch chiếu</small>
            </div>

            <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Trang chủ</a>
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link active" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                    <a class="nav-link" href="{{ route('admin.staff.index') }}">Quản lý nhân viên</a>
                    <a class="nav-link" href="{{ route('user.account.general') }}">Xem thông tin</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
                    </form>
            </nav>
        </aside>

        <main class="col-lg-10 p-4">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3>Chi tiết lịch chiếu #{{ $showtime->id }}</h3>
                </div>

                <a href="{{ route('admin.showtimes.index') }}"
                   class="btn btn-outline-light">
                    Quay lại
                </a>
            </div>

            <div class="card p-4">

                <div class="row">

                    {{-- Poster --}}
                    <div class="col-lg-3 text-center mb-4">

                        @if($showtime->movie->image_path)
                            <img
                                src="{{ asset('storage/' . $showtime->movie->image_path) }}"
                                class="poster img-fluid"
                                alt="{{ $showtime->movie->title }}">
                        @else
                            <div class="border rounded p-5">
                                Không có ảnh
                            </div>
                        @endif

                    </div>

                    {{-- Thông tin --}}
                    <div class="col-lg-9">

                        <div class="row g-4">

                            <div class="col-md-6">
                                <div class="info-label">Tên phim</div>
                                <div class="info-value">
                                    {{ $showtime->movie->title }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Thể loại</div>
                                <div class="info-value">
                                    {{ $showtime->movie->genre }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Thời lượng</div>
                                <div class="info-value">
                                    {{ $showtime->movie->duration }} phút
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Ngày khởi chiếu</div>
                                <div class="info-value">
                                    {{ $showtime->movie->release_date?->format('d/m/Y') }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Phòng chiếu</div>
                                <div class="info-value">
                                    {{ $showtime->room->name }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Tổng số ghế</div>
                                <div class="info-value">
                                    {{ $showtime->room->total_seats }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Số ghế VIP</div>
                                <div class="info-value">
                                    {{ $showtime->room->getVipSeatCount() }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Giá vé chuẩn</div>
                                <div class="info-value">
                                    {{ number_format($showtime->price_standard, 0, ',', '.') }} đ
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Bắt đầu</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i d/m/Y') }}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-label">Kết thúc</div>
                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i d/m/Y') }}
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>
</div>

</body>
</html>