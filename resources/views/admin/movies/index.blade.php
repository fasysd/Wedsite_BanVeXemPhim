<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.12); }
        .card, .content-card { background: #111827; border: 1px solid #1f2937; }
        .movie-poster { width:72px; height:100px; object-fit:cover; border-radius:.75rem; border:1px solid #334155; }
        .form-control, .btn-outline-light, .btn-success, .btn-outline-danger { background: #0f172a; color: #f8fafc; border-color: #334155; }
        .table-responsive { background: #ffffff; border-radius: 1rem; padding: 1rem; border: 1px solid #cbd5e1; }
        .table { color: #000000 !important; }
        .table thead th { background: #f8fafc; border-bottom: 1px solid #cbd5e1; color: #000000 !important; }
        .table tbody tr { background: #ffffff; }
        .table tbody td { border-color: #e2e8f0; color: #000000 !important; }
        .text-muted { color: #94a3b8 !important; }
        .table-hover tbody tr:hover { background: #f1f5f9; }
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
                            <small class="text-muted">Quản lý phim</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">A</div>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
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
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-1">Quản lý phim</h4>
                            <p class="text-muted mb-0">Xem, tìm kiếm và quản lý phim nhanh chóng.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <input id="movieSearch" type="search" class="form-control form-control-sm" placeholder="Tìm theo tên phim..." style="min-width:320px;" disabled>
                            <button type="button" class="btn btn-outline-light btn-sm" disabled>Tìm</button>
                            <a href="{{ route('admin.movies.create') }}" class="btn btn-success btn-sm">Thêm phim mới</a>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="content-card p-3 h-100">
                                <small class="text-muted">Tổng phim</small>
                                <h3 class="mb-0">12</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="content-card p-3 h-100">
                                <small class="text-muted">Tổng lịch chiếu</small>
                                <h3 class="mb-0">24</h3>
                            </div>
                        </div>
                        <div class="col-md-4 d-none d-md-block">
                            <div class="content-card p-3 h-100">
                                <small class="text-muted">Phiên bản</small>
                                <h3 class="mb-0">1.0</h3>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive rounded-4 shadow-sm">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width:60px">ID</th>
                                    <th scope="col" style="width:120px">Ảnh</th>
                                    <th scope="col">Tên phim</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Thể loại</th>
                                    <th scope="col">Ngày chiếu</th>
                                    <th scope="col">Thời lượng</th>
                                    <th scope="col" class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="small text-muted">1</td>
                                    <td>
                                        <img src="https://via.placeholder.com/72x100.png?text=Phim" alt="Phim mẫu" class="movie-poster shadow-sm">
                                    </td>
                                    <td style="min-width:220px">
                                        <div>
                                            <strong>Cuộc chiến rạp chiếu</strong>
                                            <div class="small text-muted">Hành động, giả tưởng</div>
                                        </div>
                                    </td>
                                    <td class="text-muted small">Phim bom tấn mùa hè, chiến binh rạp chiếu.</td>
                                    <td>Hành động</td>
                                    <td>15/06/2026</td>
                                    <td>120 phút</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" disabled>Sửa</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" disabled>Xóa</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="small text-muted">2</td>
                                    <td>
                                        <img src="https://via.placeholder.com/72x100.png?text=Phim" alt="Phim mẫu" class="movie-poster shadow-sm">
                                    </td>
                                    <td style="min-width:220px">
                                        <div>
                                            <strong>Thiên nhiên đen tối</strong>
                                            <div class="small text-muted">Kinh dị, tâm lý</div>
                                        </div>
                                    </td>
                                    <td class="text-muted small">Chuyến phiêu lưu rùng rợn trong một rạp tối.</td>
                                    <td>Kinh dị</td>
                                    <td>22/06/2026</td>
                                    <td>98 phút</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1" disabled>Sửa</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger" disabled>Xóa</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
