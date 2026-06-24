<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản CineGo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.12); }
        .profile-panel { background: #ffffff; border: 1px solid #dbe4f0; color: #0f172a; border-radius: 0.75rem; }
        .profile-panel .form-label,
        .profile-panel h5,
        .profile-panel p,
        .profile-panel .text-muted,
        .profile-panel strong { color: #0f172a !important; }
        .profile-panel .form-control { background: #ffffff; color: #0f172a; border-color: #cbd5e1; }
        .profile-panel .form-control:focus { box-shadow: none; border-color: #0ea5e9; }
        .btn-outline-light, .btn-success, .btn-outline-danger, .btn-primary { color: #f8fafc; border-color: #334155; }
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
                            <small class="text-muted">Tài khoản</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">A</div>
                    </div>
                </div>

                <nav class="nav flex-column">
                    <a href="{{ route('admin.movies.index') }}" class="nav-link">Quản lý phim</a>
                    <a href="{{ route('admin.showtimes.index') }}" class="nav-link">Quản lý lịch chiếu</a>
                    <a href="{{ route('admin.rooms.index') }}" class="nav-link">Quản lý phòng chiếu</a>
                    <a href="{{ route('admin.staff.index') }}" class="nav-link">Quản lý nhân viên</a>
                    <a href="{{ route('user.account.general') }}" class="nav-link active">Xem thông tin</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
                    </form>
                </nav>
            </aside>

            <main class="col-lg-10 p-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div>
                        <h4 class="mb-1">Thông tin tài khoản</h4>
                        <p class="text-muted mb-0">Xem và chỉnh sửa thông tin trong cùng một giao diện.</p>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <div class="profile-panel p-4 mb-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <h5 class="mb-3">Thông tin hiện tại</h5>
                            <p class="mb-2"><strong>Tên đăng nhập:</strong> {{ $user->username }}</p>
                            <p class="mb-2"><strong>Email:</strong> {{ $user->email }}</p>
                            <p class="mb-2"><strong>Họ và tên:</strong> {{ $user->full_name ?? 'Chưa cập nhật' }}</p>
                            <p class="mb-0"><strong>Số điện thoại:</strong> {{ $user->phone ?? 'Chưa cập nhật' }}</p>
                        </div>

                        <div class="col-md-8">
                            <h5 class="mb-3">Chỉnh sửa thông tin</h5>
                            <form method="POST" action="{{ route('user.account.detail.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Tên đăng nhập</label>
                                        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Họ và tên</label>
                                        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $user->full_name) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                                    </div>
                                </div>

                                <div class="mt-4 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                                    <a href="{{ route('user.account.general') }}" class="btn btn-outline-dark">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="profile-panel p-4">
                    <h5 class="mb-3">Đặt lại mật khẩu</h5>
                    <form method="POST" action="{{ route('user.account.password.update') }}">
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
            </main>
        </div>
    </div>
</body>
</html>