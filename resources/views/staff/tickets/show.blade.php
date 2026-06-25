<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Chi tiết vé</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body { background: #0b1220; color: #f8fafc; }
    .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
    .sidebar .nav-link { color: #e2e8f0; }
    .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.18); }
    .card, .content-card { background: #111827; border: 1px solid #1f2937; color: #f8fafc; }
    .card h4, .card h5, .card h6, .card label, .card .form-label, .card small { color: #f8fafc; }
    .table-responsive { background: #ffffff; border-radius: 1rem; padding: 1rem; border: 1px solid #cbd5e1; }
    .table thead th { background: #f8fafc; color: #000000 !important; }
    .table tbody td { color: #000000 !important; }
    .text-muted { color: #e2e8f0 !important; }
    .btn-outline-light, .btn-success, .btn-outline-danger { background: #0f172a; color: #f8fafc; border-color: #334155; }
    .form-control, .form-select, .form-control::placeholder { background: #0f172a; color: #5e6770; border-color: #334155; }
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
        <a class="nav-link" href="{{ route('user.account.general') }}">Thông tin tài khoản</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
          @csrf
          <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
        </form>
      </nav>
    </aside>
    <main class="col-lg-10 p-4">
      <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
        <div>
          <h4 class="mb-1">Chi tiết vé</h4>
          <p class="text-muted mb-0">Xem thông tin và cập nhật trạng thái vé.</p>
        </div>
        <a href="{{ route('staff.tickets') }}" class="btn btn-outline-light btn-sm">Quay lại</a>
      </div>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <div class="row g-4 mb-4">
        <div class="col-lg-6">
          <div class="section-card card p-4">
            <h5 class="mb-3">Thông tin vé</h5>
            <div class="row g-3">
              <div class="col-6">
                <small class="text-muted">Mã vé</small>
                <div>{{ $ticket->id }}</div>
              </div>
              <div class="col-6">
                <small class="text-muted">Phòng</small>
                <div>{{ $ticket->showtime?->room?->name ?? 'Chưa rõ' }}</div>
              </div>
              <div class="col-6">
                <small class="text-muted">Ghế</small>
                <div>{{ $ticket->seat?->label ?? 'Chưa rõ' }}</div>
              </div>
              <div class="col-6">
                <small class="text-muted">Trạng thái</small>
                <div>{{ $ticket->status }}</div>
              </div>
              <div class="col-12">
                <small class="text-muted">Phim</small>
                <div>{{ $ticket->showtime?->movie?->title ?? 'Chưa rõ' }}</div>
              </div>
              <div class="col-12">
                <small class="text-muted">Khách hàng</small>
                <div>{{ $ticket->booking?->user?->full_name ?? $ticket->booking?->user?->username ?? 'Chưa rõ' }}</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="section-card card p-4">
            <h5 class="mb-3">Cập nhật trạng thái</h5>
            <form method="POST" action="{{ route('staff.tickets.updateStatus', $ticket) }}">
              @csrf
              <div class="mb-3">
                <label class="form-label small text-muted">Chọn trạng thái</label>
                <select name="status" class="form-select form-select-sm" required>
                  @foreach($statuses as $value => $label)
                    <option value="{{ $value }}" {{ $ticket->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                  @endforeach
                </select>
              </div>
              <button class="btn btn-primary btn-sm">Cập nhật</button>
              <a href="{{ route('staff.tickets') }}" class="btn btn-outline-light btn-sm">Quay lại</a>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
</body>
</html>
