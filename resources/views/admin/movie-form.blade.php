<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.12); }
        .card { background: #111827; border: 1px solid #1f2937; }
        .form-control, .btn-outline-light, .btn-outline-danger, .btn-success, .btn-primary { background: #0f172a; color: #f8fafc; border-color: #334155; }
        .form-control:focus, .btn-primary:focus, .btn-success:focus, .btn-outline-danger:focus { box-shadow: none; }
        .btn-primary, .btn-success { background: #0ea5e9; border-color: #0ea5e9; }
        .btn-primary:hover, .btn-success:hover { background: #0b79b7; border-color: #0b79b7; }
        .btn-outline-danger { color: #ef4444; border-color: #ef4444; }
        .text-muted { color: #94a3b8 !important; }
        .small { color: #f8fafc !important; }
        .form-control, .table td, .table th, .card, .card * { color: #f8fafc; }
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
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Trang chủ</a>
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                    <a class="nav-link" href="{{ route('admin.staff.index') }}">Quản lý nhân viên</a>
                </nav>
                <div class="mt-4 pt-4 border-top border-secondary-subtle">
                    <div class="small text-muted mb-2">Tài khoản</div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('user.account.general') }}" class="btn btn-outline-light btn-sm">Xem thông tin</a>
                        <a href="{{ route('user.account.detail') }}" class="btn btn-outline-light btn-sm">Sửa thông tin</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm w-100">Đăng xuất</button>
                        </form>
                    </div>
                </div>
            </aside>

            <main class="col-lg-10 p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                    <div>
                        <h4 class="mb-1">{{ $title }}</h4>
                        <p class="text-muted">Điền thông tin phim tương ứng với cơ sở dữ liệu bảng <strong>movies</strong>.</p>
                    </div>
                    <a href="{{ route('admin.movies.index') }}" class="btn btn-outline-light">Quay lại</a>
                </div>

                <div class="card p-4">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @if($movie->exists)
                            @method('PUT')
                        @endif

                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Mã phim</label>
                                <input type="text" class="form-control" value="{{ $movie->exists ? $movie->id : 'Tự động' }}" disabled>
                                <small class="text-muted">ID được tạo tự động khi thêm phim mới</small>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">Tên phim</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Thể loại</label>
                                <input type="text" name="genre" class="form-control" value="{{ old('genre', $movie->genre) }}" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Ngày phát hành</label>
                                <input type="date" name="release_date" class="form-control" value="{{ old('release_date', $movie->release_date?->format('Y-m-d')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ảnh bìa (URL hoặc đường dẫn)</label>
                                <input type="text" name="image_path" class="form-control" value="{{ old('image_path', $movie->image_path) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Thời lượng (phút)</label>
                                <input type="number" name="duration" class="form-control" min="1" value="{{ old('duration', $movie->duration) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Ngày tạo</label>
                                <input type="text" class="form-control" value="{{ $movie->created_at ? $movie->created_at->format('d/m/Y') : 'Tự động' }}" disabled>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Mô tả</label>
                                <textarea name="description" class="form-control" rows="5">{{ old('description', $movie->description) }}</textarea>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <a href="{{ route('admin.movies.index') }}" class="btn btn-outline-light">Hủy</a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
