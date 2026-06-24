<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ticket #{{ $ticket->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .mb-4 { margin-bottom: 1.5rem; }
        .sidebar h5 { font-size: 1rem; font-weight: 600; }
        .sidebar small { font-size: 0.875rem; }
        .sidebar .nav-link { color: #94a3b8; padding: 0.5rem 1rem; margin-bottom: 0.25rem; border-radius: 0.25rem; transition: all 0.2s; }
        .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.2); }
        .sidebar .nav-link.active { color: #f8fafc; background: rgba(14,165,233,0.3); font-weight: 500; }
        .sidebar form { width: 100%; }
        .card { background: #111827; border: 1px solid #1f2937; }
        .form-control, .form-select { background: #ffffff !important; color: #0f172a !important; border-color: #d1d5db !important; }
        .form-control::placeholder { color:#6b7280; }
        .form-control:disabled { background: #f8fafc !important; color: #0f172a !important; opacity: 1 !important; }
        .table { color: #000 }
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
                <a href="{{ route('staff.tickets') }}" class="btn btn-outline-light mb-3">Quay lại</a>
                <div class="card p-3">
                    <h3>Ticket #{{ $ticket->id }}</h3>
                    <p><strong>Booking:</strong> #{{ $ticket->booking_id }}</p>
                    <p><strong>User:</strong> {{ $ticket->booking->user?->username ?? 'User' }}</p>
                    <p><strong>Seat:</strong> {{ $ticket->seat?->seat_row }}{{ $ticket->seat?->seat_number }}</p>
                    <p><strong>Status:</strong> {{ $ticket->status }}</p>
                    <form method="POST" action="{{ route('staff.tickets.updateStatus', $ticket) }}">@csrf @method('PUT')
                        <div class="mb-2">
                            <label class="form-label">Cập nhật trạng thái</label>
                            <input name="status" class="form-control form-control-sm" value="{{ $ticket->status }}">
                        </div>
                        <button class="btn btn-primary btn-sm">Cập nhật</button>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
