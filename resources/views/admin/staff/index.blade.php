<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.12); }
        .card, .content-card { background: #111827; border: 1px solid #1f2937; }
        .form-control, .btn-outline-light, .btn-success, .btn-outline-danger, .btn-primary { background: #0f172a; color: #f8fafc; border-color: #334155; }
        .btn-success { background: #22c55e; border-color: #22c55e; }
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
                            <small class="text-muted">Quản lý nhân viên</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">A</div>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Trang chủ</a>
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
                        <h4 class="mb-1">Quản lý nhân viên</h4>
                        <p class="text-muted mb-0">Thêm, sửa thông tin và đặt lại mật khẩu cho tài khoản nhân viên.</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.staff.create') }}" class="btn btn-success">Thêm nhân viên</a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive rounded-4 shadow-sm">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" style="width:60px">ID</th>
                                <th scope="col">Tài khoản</th>
                                <th scope="col">Họ và tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Vai trò</th>
                                <th scope="col" class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($staffMembers as $staff)
                                <tr>
                                    <td class="small text-muted">{{ $staff->id }}</td>
                                    <td><strong>{{ $staff->username }}</strong></td>
                                    <td>{{ $staff->full_name ?? 'Chưa cập nhật' }}</td>
                                    <td>{{ $staff->email }}</td>
                                    <td>{{ $staff->phone ?? 'Chưa cập nhật' }}</td>
                                    <td>{{ $staff->role }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.staff.edit', $staff) }}" class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">Chưa có nhân viên nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>