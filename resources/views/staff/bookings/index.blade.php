<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff - Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .mb-4 { margin-bottom: 1.5rem; }
        .sidebar h5 { font-size: 1rem; font-weight: 600; }
        .sidebar small { font-size: 0.875rem; }
        .sidebar .nav { margin-top: 1rem; }
        .sidebar .nav-link { color: #94a3b8; padding: 0.5rem 1rem; margin-bottom: 0.25rem; border-radius: 0.25rem; transition: all 0.2s; }
        .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.2); }
        .sidebar .nav-link.active { color: #f8fafc; background: rgba(14,165,233,0.3); font-weight: 500; }
        .sidebar form { width: 100%; }
        .white-card { background: #ffffff; border-radius: 1rem; padding: 1.25rem; border: 1px solid #e6edf3; color: #000 }
        .dark-card { background: #0f172a; border-radius: .75rem; padding: 1.25rem; border: 1px solid #1f2937 }
        .movie-table thead th { background: #f8fafc; }
        .btn-outline-secondary { color: #0f172a; }
        .form-control { background: #0b1220; color: #fff; border-color:#1f2937 }
        .form-control::placeholder { color:#94a3b8 }
        .btn-primary { background:#0ea5e9; border-color:#0ea5e9 }
        .btn-outline-danger { border-color: #ef4444; color: #ef4444; }
        .btn-outline-danger:hover { background: #ef4444; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 sidebar p-3">
                <div class="mb-4 text-white">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="mb-1">CineGo Staff</h5>
                            <small class="text-muted">Giao diện nhân viên</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">S</div>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="{{ route('staff.bookings') }}">Danh sách đặt vé</a>
                    <a class="nav-link" href="{{ route('staff.tickets') }}">Tra cứu vé</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
                    </form>
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-1">Danh sách đặt vé</h4>
                            
                        </div>
                    </div>

                    <div class="white-card mb-4">
                        <div class="table-responsive">
                        <table class="table table-hover align-middle movie-table mb-0">
                            <thead>
                                <tr>
                                    <th>Mã vé</th>
                                    <th>Khách hàng</th>
                                    <th>Phòng</th>
                                    <th>Ghế</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $year = date('Y'); @endphp
                                @foreach($bookings as $b)
                                    @foreach($b->ticketDetails as $t)
                                    <tr>
                                        <td>{{ 'VE-' . $year . '-' . str_pad($t->id, 3, '0', STR_PAD_LEFT) }}</td>
                                        <td>{{ $b->user?->full_name ?? $b->user?->username }}</td>
                                        <td>{{ $t->showtime?->room?->name ?? 'R' . ($t->showtime?->room_id ?? '') }}</td>
                                        <td>{{ $t->seat?->seat_row }}{{ $t->seat?->seat_number }}</td>
                                        <td>{{ $t->status }}</td>
                                        <td>
                                            <a href="{{ route('staff.bookings.show', $b) }}" class="btn btn-sm btn-outline-primary">Cập nhật</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card p-3">
                                <h5>Tìm vé cần xử lý</h5>
                                <form method="GET" action="{{ route('staff.tickets') }}" class="mt-3">
                                    <div class="mb-2">
                                        <label class="form-label">Mã vé</label>
                                        <input name="q" class="form-control" placeholder="VE-2026-001" value="{{ $q ?? '' }}">
                                    </div>
                                    <button class="btn btn-primary">Tìm vé</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card p-3">
                                <h5>Trạng thái mới</h5>
                                <form method="POST" action="{{ route('staff.tickets.updateStatus', 0) }}" onsubmit="return confirm('Cập nhật trạng thái?')">
                                    @csrf @method('PUT')
                                    <div class="mb-2">
                                        <label class="form-label">Chọn trạng thái</label>
                                        <select name="status" class="form-control">
                                            <option>Đang chờ</option>
                                            <option>Đã xác nhận</option>
                                            <option>Đã sử dụng</option>
                                            <option>Hủy</option>
                                        </select>
                                    </div>
                                    <button class="btn btn-outline-light">Cập nhật trạng thái</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
