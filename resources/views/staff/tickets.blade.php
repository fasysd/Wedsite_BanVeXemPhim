<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tra cứu vé</title>
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
      </nav>
    </aside>
    <main class="col-lg-10 p-4">
      <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
        <div>
          <h4 class="mb-1">Tra cứu vé</h4>
        </div>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-light btn-sm" disabled>Đăng nhập</button>
          <button class="btn btn-outline-light btn-sm" disabled>Đăng xuất</button>
        </div>
      </div>
      <div class="row g-4 mb-4">
        <div class="col-lg-6">
          <div class="section-card card p-4">
            <h5 class="mb-3">Thông tin vé</h5>
            <div class="row g-3">
              <div class="col-6">
                <small class="text-muted">Mã vé</small>
                <div>VE-2026-001</div>
              </div>
              <div class="col-6">
                <small class="text-muted">Phòng</small>
                <div>Rạp 3</div>
              </div>
              <div class="col-6">
                <small class="text-muted">Ghế</small>
                <div>B5</div>
              </div>
              <div class="col-6">
                <small class="text-muted">Status</small>
                <div>Đã xác nhận</div>
              </div>
              <div class="col-12">
                <small class="text-muted">Phim</small>
                <div>Cuộc chiến rạp chiếu</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="section-card card p-4">
            <h5 class="mb-3">Cập nhật trạng thái</h5>
            <div class="mb-3">
              <label class="form-label small text-muted">Mã vé</label>
              <input type="text" class="form-control form-control-sm" value="VE-2026-001" disabled>
            </div>
            <div class="mb-3">
              <label class="form-label small text-muted">Chọn trạng thái</label>
              <select class="form-select form-select-sm" disabled>
                <option selected>Đã xác nhận</option>
                <option>Đã sử dụng</option>
                <option>Hủy vé</option>
                <option>Đang chờ</option>
              </select>
            </div>
            <div class="d-flex gap-2">
              <button class="btn btn-primary btn-sm" disabled>Cập nhật</button>
              <button class="btn btn-outline-light btn-sm" disabled>Hủy</button>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive rounded-4 shadow-sm">
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
            <tr>
              <td>VE-2026-001</td>
              <td>Cuộc chiến rạp chiếu</td>
              <td>B5</td>
              <td>Đã xác nhận</td>
              <td><button class="btn btn-sm btn-outline-primary" disabled>Cập nhật</button></td>
            </tr>
            <tr>
              <td>VE-2026-002</td>
              <td>Thiên nhiên đen tối</td>
              <td>C9</td>
              <td>Đang chờ</td>
              <td><button class="btn btn-sm btn-outline-primary" disabled>Cập nhật</button></td>
            </tr>
            <tr>
              <td>VE-2026-003</td>
              <td>Ngày mới trong rạp</td>
              <td>A2</td>
              <td>Đã sử dụng</td>
              <td><button class="btn btn-sm btn-outline-primary" disabled>Cập nhật</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>
</body>
</html>
