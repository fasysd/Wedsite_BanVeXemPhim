<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Booking #{{ $booking->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Toàn bộ trang */
        body { background: #0b1220; color: #ffffff !important; }
        
        /* Sidebar bên trái */
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .mb-4 { margin-bottom: 1.5rem; }
        .sidebar h5 { font-size: 1rem; font-weight: 600; color: #ffffff; }
        .sidebar small { font-size: 0.875rem; }
        .sidebar .nav-link { color: #94a3b8; padding: 0.5rem 1rem; margin-bottom: 0.25rem; border-radius: 0.25rem; transition: all 0.2s; }
        .sidebar .nav-link:hover { color: #ffffff; background: rgba(14,165,233,0.2); }
        .sidebar .nav-link.active { color: #ffffff; background: rgba(14,165,233,0.3); font-weight: 500; }
        .sidebar form { width: 100%; }

        /* Card hiển thị nội dung - ĐÃ SỬA GỘP THÀNH MỘT VÀ ÉP CHỮ TRẮNG TINH */
        .card { 
            background: #111827 !important; 
            border: 1px solid #1f2937 !important; 
            color: #ffffff !important; 
        }
        
        /* Tất cả tiêu đề và chữ nhỏ bên trong Card phải trắng */
        .card h4, .card h5, .card label, .card strong, .card span, .card div {
            color: #ffffff !important;
        }

        /* ÉP CHỮ TRẮNG CHO Ô INPUT VÀ Ô SELECT (Không còn bị đen thui nữa) */
        .form-control, .form-select { 
            background-color: #1f2937 !important; 
            border-color: #374151 !important; 
            color: #ffffff !important; 
            font-weight: 500;
        }

        /* Ô Input khi bị khóa (disabled) vẫn giữ chữ trắng sáng rõ ràng */
        .form-control:disabled {
            background-color: #0b1220 !important;
            color: #090909 !important;
            opacity: 1 !important; /* Ngăn trình duyệt làm mờ chữ */
            -webkit-text-fill-color: #ffffff !important; /* Ép riêng cho trình duyệt Chrome/Safari */
        }

        /* Bảng danh sách */
        .table { color: #ffffff !important; }
        .btn-outline-danger { border-color: #ef4444; color: #ef4444; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
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
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
                    </form>
                </nav>
            </aside>
            
            <!-- Nội dung chính -->
            <main class="col-lg-10 p-4">
                <a href="{{ route('staff.bookings') }}" class="btn btn-outline-light mb-3">Quay lại</a>
                
                <!-- Khối thông tin -->
                <div class="card p-4 mb-4">
                    <div class="row">
                        <!-- Cột trái: Thông tin vé -->
                        <div class="col-md-7 border-end border-secondary border-opacity-25">
                            <h4 class="mb-3" style="color: #0ea5e9 !important;">Thông tin vé</h4>
                            @if($booking->ticketDetails && $booking->ticketDetails->count() > 0)
                                @foreach($booking->ticketDetails as $t)
                                    <div class="mb-3 p-3 rounded" style="background: #1f2937;">
                                        <div class="mb-1"><strong>Mã vé:</strong> <span>{{ 'VE-' . date('Y') . '-' . str_pad($t->id,3,'0',STR_PAD_LEFT) }}</span></div>
                                        <div class="mb-1"><strong>Ghế:</strong> <span>{{ $t->seat?->seat_row }}{{ $t->seat?->seat_number }}</span></div>
                                        <div><strong>Phim:</strong> <span>{{ $t->showtime?->movie?->title ?? '-' }}</span></div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-muted">Không có vé.</div>
                            @endif
                        </div>
                        
                        <!-- Cột phải: Cập nhật trạng thái -->
                        <div class="col-md-5 ps-md-4">
                            <h4 class="mb-3" style="color: #0ea5e9 !important;">Cập nhật trạng thái</h4>
                            <form method="POST" action="{{ route('staff.bookings.updateStatus', $booking) }}">
                                @csrf @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Mã vé (tự động)</label>
                                    <input class="form-control" value="{{ 'VE-' . date('Y') . '-' . str_pad($booking->ticketDetails->first()?->id ?? 0,3,'0',STR_PAD_LEFT) }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Chọn trạng thái</label>
                                    <select name="status" class="form-select">
                                        <option {{ $booking->status=='Đang chờ' ? 'selected' : ''}}>Đang chờ</option>
                                        <option {{ $booking->status=='Đã xác nhận' ? 'selected' : ''}}>Đã xác nhận</option>
                                        <option {{ $booking->status=='Đã sử dụng' ? 'selected' : ''}}>Đã sử dụng</option>
                                        <option {{ $booking->status=='Hủy' ? 'selected' : ''}}>Hủy</option>
                                    </select>
                                </div>
                                <div class="d-flex gap-2 mt-4">
                                    <button type="submit" class="btn btn-info text-white px-4">Cập nhật</button>
                                    <a href="{{ route('staff.bookings') }}" class="btn btn-outline-light px-4">Hủy</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>