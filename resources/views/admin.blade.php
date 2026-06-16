<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.12); }
        .card, .content-card { background: #111827; border: 1px solid #1f2937; }
        .section-card { border-radius: 1rem; padding: 1.75rem; transition: transform .2s ease, box-shadow .2s ease; }
        .section-card:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(0,0,0,.12); }
        .btn-action { min-width: 160px; }
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
                            <small class="text-muted">Chọn chức năng quản lý</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">A</div>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">Admin</a>
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="mb-4">
                    <h4 class="mb-1">Trang quản lý</h4>
                    <p class="text-muted">Giao diện admin tĩnh. Chọn một trong ba trang quản lý để xem UI demo.</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="section-card card p-4 h-100 text-white">
                            <h5>Quản lý phim</h5>
                            <p class="text-muted">Xem danh sách phim, thông tin và thao tác.</p>
                            <a href="{{ route('admin.movies.index') }}" class="btn btn-primary btn-action">Mở trang phim</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="section-card card p-4 h-100 text-white">
                            <h5>Quản lý lịch chiếu</h5>
                            <p class="text-muted">Xem lịch chiếu của phim trên các phòng.</p>
                            <a href="{{ route('admin.showtimes.index') }}" class="btn btn-primary btn-action">Mở trang lịch chiếu</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="section-card card p-4 h-100 text-white">
                            <h5>Quản lý phòng chiếu</h5>
                            <p class="text-muted">Xem tổng quan phòng chiếu và ghế VIP.</p>
                            <a href="{{ route('admin.rooms.index') }}" class="btn btn-primary btn-action">Mở trang phòng chiếu</a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
