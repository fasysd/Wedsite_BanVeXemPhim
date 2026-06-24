<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Staff - Tickets</title>
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
        .white-card { background: #ffffff; border-radius: 1rem; padding: 1.25rem; border: 1px solid #000000; color: #000 }
        .panel-card { background: #f8fafc; border-radius: .75rem; padding: 1.25rem; border: 1px solid #000000; color: #0f172a }
        .panel-card h5 { color: #0f172a; }
        .panel-card .form-control,
        .panel-card .form-select { background: #ffffff; color: #0f172a; border-color: #000000; }
        .panel-card .form-control:disabled { background: #f8fafc; color: #0f172a; opacity: 1; }
        .form-control { background: #ffffff; color: #0f172a; border-color:#000000 }
        .form-control::placeholder { color:#6b7280 }
        .btn-primary { background:#0ea5e9; border-color:#0ea5e9 }
        .btn-outline-danger { border-color: #ef4444; color: #ef4444; }
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
                    <a class="nav-link" href="{{ route('staff.bookings') }}">Danh sách đặt vé</a>
                    <a class="nav-link active" href="{{ route('staff.tickets') }}">Tra cứu vé</a>
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
                            <h4 class="mb-1">Tra cứu vé</h4>
                            <p class="text-muted mb-0">Tra cứu và cập nhật trạng thái vé.</p>
                        </div>
                    </div>

                    <div class="white-card mb-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="panel-card">
                                    <h5>Thông tin vé</h5>
                                    @if($tickets->isEmpty())
                                        <div class="p-2">Không có vé.</div>
                                    @else
                                        <ul class="list-unstyled mt-2 mb-0">
                                        @foreach($tickets as $t)
                                            <li class="mb-2"><strong>Mã vé:</strong> {{ 'VE-' . date('Y') . '-' . str_pad($t->id,3,'0',STR_PAD_LEFT) }}<br><strong>Ghế:</strong> {{ $t->seat?->seat_row }}{{ $t->seat?->seat_number }}<br><strong>Status:</strong> {{ $t->status }}</li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel-card">
                                    <h5>Cập nhật trạng thái</h5>
                                    <form method="POST" action="{{ route('staff.tickets.updateStatus', $tickets->first()?->id ?? 0) }}">
                                        @csrf @method('PUT')
                                        <div class="mb-2">
                                            <label class="form-label">Mã vé</label>
                                            <input class="form-control" value="{{ request('q') ?? '' }}">
                                        </div>
                                        <div class="mb-2">
                                            <label class="form-label">Chọn trạng thái</label>
                                            <select name="status" class="form-control">
                                                <option>Đang chờ</option>
                                                <option>Đã xác nhận</option>
                                                <option>Đã sử dụng</option>
                                                <option>Hủy</option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary">Cập nhật</button>
                                        <a href="{{ route('staff.tickets') }}" class="btn btn-outline-light ms-2">Hủy</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="white-card">
                        <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã vé</th>
                                    <th>Phim</th>
                                    <th>Ghế</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tickets as $t)
                                <tr>
                                    <td>{{ 'VE-' . date('Y') . '-' . str_pad($t->id,3,'0',STR_PAD_LEFT) }}</td>
                                    <td>{{ $t->showtime?->movie?->title ?? '-' }}</td>
                                    <td>{{ $t->seat?->seat_row }}{{ $t->seat?->seat_number }}</td>
                                    <td>{{ $t->status }}</td>
                                    <td><a class="btn btn-sm btn-outline-secondary" href="{{ route('staff.tickets.show', $t) }}">Cập nhật</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
