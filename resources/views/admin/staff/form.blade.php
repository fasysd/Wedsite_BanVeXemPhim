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
        .staff-panel { background: #ffffff; border: 1px solid #dbe4f0; color: #0f172a; border-radius: 0.75rem; }
        .staff-panel .form-label,
        .staff-panel h5,
        .staff-panel p,
        .staff-panel .text-muted { color: #0f172a !important; }
        .staff-panel .form-control { background: #ffffff; color: #0f172a; border-color: #cbd5e1; }
        .staff-panel .form-control:focus { box-shadow: none; border-color: #0ea5e9; }
        .btn-outline-light, .btn-success, .btn-outline-danger, .btn-primary { color: #f8fafc; border-color: #334155; }
        .btn-success { background: #22c55e; border-color: #22c55e; }
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
                            <small class="text-muted">Quản lý nhân viên</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">A</div>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                    <a class="nav-link active" href="{{ route('admin.staff.index') }}">Quản lý nhân viên</a>
                    <a class="nav-link" href="{{ route('user.account.general') }}">Xem thông tin</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
                    </form>
                </nav>
            </aside>

            <main class="col-lg-10 p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div>
                        <h4 class="mb-1">{{ $title }}</h4>
                        <p class="text-muted mb-0">Cập nhật thông tin tài khoản nhân viên và đặt lại mật khẩu khi cần.</p>
                    </div>
                    <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-light">Quay lại</a>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <div class="staff-panel p-4 mb-4">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @if($method !== 'POST')
                            @method($method)
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tên đăng nhập</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username', $staff->username) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $staff->email) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Họ và tên</label>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $staff->full_name) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $staff->phone) }}">
                            </div>

                            @if(! $isEdit)
                                <div class="col-md-6">
                                    <label class="form-label">Mật khẩu</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Xác nhận mật khẩu</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <a href="{{ route('admin.staff.index') }}" class="btn btn-outline-dark">Hủy</a>
                        </div>
                    </form>
                </div>

                @if($isEdit)
                    <div class="staff-panel p-4" id="reset-password">
                        <h5 class="mb-3">Đặt lại mật khẩu</h5>
                        <form method="POST" action="{{ route('admin.staff.reset-password', $staff) }}">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Mật khẩu mới</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Xác nhận mật khẩu mới</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Đặt lại mật khẩu</button>
                            </div>
                        </form>
                    </div>
                @endif
            </main>
        </div>
    </div>
</body>
</html>