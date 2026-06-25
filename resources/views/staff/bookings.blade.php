<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Danh sách đặt vé</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Đổi màu chữ mặc định của body sang màu sáng để nổi bật trên nền tối */
    body { 
        background: #0b1220; 
        color: #f8fafc; 
    }
    
    .sidebar { 
        min-height: 100vh; 
        background: #0f172a; 
        border-right: 1px solid #1e293b; /* Giảm độ sáng của border xuống cho đỡ gắt */
    }
    
    .sidebar .nav-link { 
        color: #e2e8f0; /* Chữ sidebar rõ hơn */
    }
    
    .sidebar .nav-link.active, .sidebar .nav-link:hover { 
        color: #ffffff; 
        background: rgba(255, 255, 255, 0.16); 
    }
    
    /* Card nền tối với chữ nội dung sáng rõ */
    .card, .content-card { 
        background: #111827; 
        border: 1px solid #374151; 
        color: #f8fafc;
    }
    .card h4, .card h5, .card h6, .card label, .card .form-label, .card small {
        color: #f8fafc;
    }
    
    /* Bảng nền trắng giữ nguyên nhưng tinh chỉnh border cho thanh thoát */
    .table-responsive { 
        background: #ffffff; 
        border-radius: 1rem; 
        padding: 1rem; 
        border: 1px solid #e2e8f0; 
    }
    
    .table thead th { 
        background: #f8fafc; 
        color: #0f172a !important; 
        font-weight: 600;
    }
    
    .table tbody td { 
        color: #334155 !important; 
    }  
    
    /* Đổi màu text-muted thành màu xám rõ hơn trên nền tối */
    .text-muted { 
        color: #cbd5e1 !important; 
    }
    
    /* Nút bấm trên nền tối */
    .btn-outline-light, .btn-success, .btn-outline-danger { 
        background: #1e293b; 
        color: #ffffff; 
        border-color: #475569; 
    }
    .btn-outline-light:hover {
        background: #334155;
    }
    
    /* Các ô nhập liệu (Input, Select) */
    .form-control, .form-select { 
        background: #0f172a; 
        color: #8f8f8f; 
        border-color: #334155; 
    }
    
    /* Placeholder phải có màu xám vừa phải để không bị lẫn với chữ nhập vào */
    .form-control::placeholder { 
        color: #64748b; 
    }
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
        <a class="nav-link active" href="{{ route('staff.bookings') }}">Danh sách đặt vé</a>
        <a class="nav-link" href="{{ route('staff.tickets') }}">Tra cứu vé</a>
        <a class="nav-link" href="{{ route('user.account.general') }}">Thông tin tài khoản</a>
        <form method="POST" action="{{ route('logout') }}" class="mt-2">
          @csrf
          <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
        </form>
      </nav>
    </aside>
    <main class="col-lg-10 p-4">
      <div class="d-flex justify-content-between align-items-center mb-4 gap-3">
        <div>
          <h4 class="mb-1">Danh sách đặt vé</h4>
        </div>
      </div>
      <div class="table-responsive rounded-4 shadow-sm mb-4">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>Mã vé</th>
              <th>Khách hàng</th>
              <th>Phòng</th>
              <th>Ghế</th>
              <th>Trạng thái</th>
              <th>Hành động</th>
            </tr>
          </thead>
          <tbody>
            @forelse($tickets as $ticket)
              <tr>
                <td>{{ $ticket->id }}</td>
                <td>{{ $ticket->booking?->user->full_name ?? $ticket->booking?->user->username ?? 'Khách ẩn danh' }}</td>
                <td>{{ $ticket->showtime?->room?->name ?? 'Chưa rõ' }}</td>
                <td>{{ $ticket->seat?->label ?? 'Chưa rõ' }}</td>
                <td>{{ $ticket->status }}</td>
                <td>
                  <a href="{{ route('staff.tickets.show', $ticket) }}" class="btn btn-sm btn-outline-primary">Cập nhật</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center py-4">Không có vé nào.</td>
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
