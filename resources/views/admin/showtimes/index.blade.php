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
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div>
                        <h4 class="mb-1">Quản lý lịch chiếu</h4>
                        <p class="text-muted mb-0">Giao diện demo chỉ hiển thị bảng lịch chiếu. Mọi thao tác hiện tại không hoạt động.</p>
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
                            <tr>
                                <td class="small text-muted">1</td>
                                <td>Cuộc chiến rạp chiếu</td>
                                <td>Phòng A</td>
                                <td>15:00 15/06/2026</td>
                                <td>17:00 15/06/2026</td>
                                <td>120.000 đ</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" disabled>Sửa</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" disabled>Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td class="small text-muted">2</td>
                                <td>Thiên nhiên đen tối</td>
                                <td>Phòng B</td>
                                <td>18:30 16/06/2026</td>
                                <td>20:10 16/06/2026</td>
                                <td>100.000 đ</td>
                                <td class="text-end">
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" disabled>Sửa</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" disabled>Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
