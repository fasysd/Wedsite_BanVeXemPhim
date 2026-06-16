<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm phòng chiếu mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height:100vh; background:#0f172a; border-right:1px solid #1f2937; }
        .sidebar .nav-link { color:#94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color:#f8fafc; background:rgba(14,165,233,0.12); }
        .card { background:#111827; border:1px solid #1f2937; }
        .form-control, .btn-outline-light, .btn-primary { background:#0f172a; color:#f8fafc; border-color:#334155; }
        .form-control::placeholder { color: rgba(255,255,255,0.2); opacity: 1; }
        .btn-primary { background:#0ea5e9; border-color:#0ea5e9; }
        .btn-primary:hover { background:#38bdf8; color:#0f172a; }
        .text-muted { color:#94a3b8 !important; }
        .form-control, .card, .card * { color:#f8fafc; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 sidebar p-3">
                <div class="mb-4 text-white">
                    <h5 class="mb-1">CineGo Admin</h5>
                    <small class="text-muted">Thêm phòng chiếu mới</small>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div>
                        <h4 class="mb-1">Thêm phòng chiếu mới</h4>
                        <p class="text-muted mb-0">Giao diện form thêm phòng chiếu, chưa gửi dữ liệu về controller.</p>
                    </div>
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-light">Quay lại</a>
                </div>
                <div class="card p-4">
                    <form onsubmit="event.preventDefault()">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">ID</label>
                                <input type="text" class="form-control" placeholder="Nhập ID">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Tên phòng</label>
                                <input type="text" class="form-control" placeholder="Nhập tên phòng">
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Tổng số ghế</label>
                                <input type="number" class="form-control" min="1" placeholder="120">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Số ghế mỗi hàng</label>
                                <input type="number" class="form-control" min="1" placeholder="10">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Loại phòng</label>
                                <select class="form-control">
                                    <option>Tiêu chuẩn</option>
                                    <option>VIP</option>
                                    <option>IMAX</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Số ghế VIP</label>
                                <input type="number" class="form-control" min="0" placeholder="12">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Danh sách ghế VIP</label>
                                <input type="text" class="form-control" placeholder="A1,A2,B3...">
                            </div>
                        </div>
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-light">Hủy</a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
