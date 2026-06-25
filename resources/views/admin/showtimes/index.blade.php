<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý lịch chiếu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.12); }
        .card, .content-card { background: #111827; border: 1px solid #1f2937; }
        .form-control, .btn-outline-light, .btn-success, .btn-outline-danger { background: #0f172a; color: #f8fafc; border-color: #334155; }
        .btn-success { background: #22c55e; border-color: #22c55e; }
        .btn-outline-danger { color: #ef4444; border-color: #ef4444; }
        .table-responsive { background: #ffffff; border-radius: 1rem; padding: 1rem; border: 1px solid #cbd5e1; }
        .table th, .table td { color: #000000 !important; }
        .table thead th { background: #f8fafc; border-bottom: 1px solid #cbd5e1; color: #000000 !important; }
        .table tbody tr { background: #ffffff; }
        .text-muted { color: #94a3b8 !important; }
    </style>
</head>
<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 sidebar p-3">
                <div class="mb-4 text-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1">CineGo Admin</h5>
                            <small class="text-muted">Quản lý lịch chiếu</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">A</div>
                    </div>
                </div>
                <nav class="nav flex-column">
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
                <div class="d-flex justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div>
                        <h4 class="mb-1">Quản lý lịch chiếu</h4>
                    </div>
                    <a href="{{ route('admin.showtimes.create') }}" class="btn btn-success">Thêm lịch chiếu mới</a>
                </div>
                <div class="table-responsive rounded-4">
                    <table class="table table-borderless align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width:60px">ID</th>
                                <th>Phim</th>
                                <th>Phòng</th>
                                <th>Bắt đầu</th>
                                <th>Kết thúc</th>
                                <th>Giá</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($showtimes as $showtime)
                                <tr>
                                    <td class="small text-muted">
                                        {{ $showtime->id }}
                                    </td>

                                    <td>
                                        {{ $showtime->movie->title ?? 'Không có phim' }}
                                    </td>

                                    <td>
                                        {{ $showtime->room->name ?? 'Không có phòng' }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i d/m/Y') }}
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i d/m/Y') }}
                                    </td>

                                    <td>
                                        {{ number_format($showtime->price_standard, 0, ',', '.') }} đ
                                    </td>

                                    <td class="text-end">
                                        <a href="{{ route('admin.showtimes.show', $showtime->id) }}"
                                        class="btn btn-sm btn-outline-info me-1">
                                            Xem
                                        </a>

                                        <a href="{{ route('admin.showtimes.edit', $showtime->id) }}"
                                        class="btn btn-sm btn-outline-primary me-1">
                                            Sửa
                                        </a>

                                        <form action="{{ route('admin.showtimes.destroy', $showtime->id) }}"
                                            method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    onclick="return confirm('Bạn có chắc muốn xóa lịch chiếu này?')">
                                                Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        Chưa có lịch chiếu nào
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
