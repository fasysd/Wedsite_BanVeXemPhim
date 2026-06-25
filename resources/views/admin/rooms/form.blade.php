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
        .form-control, .btn-outline-light, .btn-primary { background: #0f172a; color: #f8fafc; border-color: #334155; }
        .btn-primary { background: #0ea5e9; border-color: #0ea5e9; }
        .btn-primary:hover { background: #38bdf8; color: #0f172a; }
        .text-muted { color: #94a3b8 !important; }
            .seat-map table td {
                color: #000000 !important;
            }
            .seat-map table th {
                color: #000000 !important;
            }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 sidebar p-3">
                <div class="mb-4 text-white">
                    <h5 class="mb-1">CineGo Admin</h5>
                    <small class="text-muted">Quản lý phòng chiếu</small>
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">{{ $title }}</h4>
                        <p class="text-muted mb-0">Thiết lập phòng chiếu, tổng số ghế và ghế VIP.</p>
                    </div>
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-light">Quay lại</a>
                </div>
                <div class="card p-4">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @if($room->exists)
                            @method('PUT')
                        @endif
                        <div class="row g-3">
                            <input type="hidden" name="id" value="{{ $room->id }}">
                            <div class="col-md-6">
                                <label class="form-label">Tên phòng</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $room->name) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Chọn cấu hình ghế</label>
                                <select id="seatPreset" class="form-control" aria-label="Chọn cấu hình ghế">
                                    <option value="">-- Chọn preset --</option>
                                    <option value="10x5">10 x 5</option>
                                    <option value="10x10">10 x 10</option>
                                    <option value="8x8">8 x 8</option>
                                    <option value="15x10">15 x 10</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tổng số ghế</label>
                                <input id="totalSeats" type="number" name="total_seats" class="form-control" min="1" value="{{ old('total_seats', $room->total_seats) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Ghế mỗi hàng</label>
                                <input id="seatsPerRow" type="number" name="seats_per_row" class="form-control" min="1" value="{{ old('seats_per_row', $seatsPerRow ?? 10) }}" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Danh sách ghế VIP</label>
                                <input id="vipSeatsInput" type="text" name="vip_seats" class="form-control" value="{{ old('vip_seats', $vipSeats ?? '') }}" placeholder="Ví dụ: A1,A2,B3">
                                <div class="form-text text-muted">Nhập mã ghế cách nhau bằng dấu phẩy nếu muốn. Hoặc click vào ghế để đánh dấu VIP.</div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button id="renderSeats" type="button" class="btn btn-outline-light">Hiển thị sơ đồ ghế</button>
                        </div>

                        <div id="seatMap" class="mt-4"></div>
                        <div id="seatLegend" class="mt-3 d-flex gap-3 align-items-center text-white">
                            <span class="d-flex align-items-center gap-2"><span class="badge bg-warning" style="width:18px;height:18px;"></span>VIP</span>
                            <span class="d-flex align-items-center gap-2"><span class="badge bg-transparent border border-light" style="width:18px;height:18px;"></span>Bình thường</span>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Lưu phòng</button>
                        </div>
                    </form>
                </div>
                <script>
                    const presets = {
                        '10x5': {total: 50, perRow: 10},
                        '10x10': {total: 100, perRow: 10},
                        '8x8': {total: 64, perRow: 8},
                        '15x10': {total: 150, perRow: 10}
                    };
                    const seatPreset = document.getElementById('seatPreset');
                    const totalSeats = document.getElementById('totalSeats');
                    const seatsPerRow = document.getElementById('seatsPerRow');
                    const vipSeatsInput = document.getElementById('vipSeatsInput');
                    const seatMap = document.getElementById('seatMap');
                    const renderButton = document.getElementById('renderSeats');

                    function normalizeSeatCode(code) {
                        return code.toUpperCase().trim();
                    }

                    function getVipSeats() {
                        return (vipSeatsInput.value || '')
                            .split(',')
                            .map(normalizeSeatCode)
                            .filter(Boolean);
                    }

                    function updateVipInputFromMap() {
                        const vipCodes = Array.from(seatMap.querySelectorAll('button.btn-warning'))
                            .map(btn => btn.dataset.code);
                        vipSeatsInput.value = vipCodes.join(',');
                    }

                    function renderSeatMap() {
                        const total = parseInt(totalSeats.value, 10) || 0;
                        const perRow = parseInt(seatsPerRow.value, 10) || 1;
                        const vipCodes = getVipSeats();
                        if (total <= 0 || perRow <= 0) {
                            seatMap.innerHTML = '<div class="text-muted">Vui lòng nhập tổng ghế và ghế mỗi hàng hợp lệ.</div>';
                            return;
                        }
                        const rows = Math.ceil(total / perRow);
                        seatMap.innerHTML = '';
                        for (let rowIndex = 0; rowIndex < rows; rowIndex++) {
                            const rowName = String.fromCharCode(65 + rowIndex);
                            const rowDiv = document.createElement('div');
                            rowDiv.className = 'd-flex flex-wrap gap-2 mb-2';
                            for (let num = 1; num <= perRow; num++) {
                                const seatIndex = rowIndex * perRow + num;
                                const code = `${rowName}${num}`;
                                const btn = document.createElement('button');
                                btn.type = 'button';
                                btn.className = 'btn btn-sm';
                                btn.dataset.code = code;
                                btn.textContent = code;
                                if (seatIndex > total) {
                                    btn.classList.add('btn-secondary', 'disabled');
                                } else {
                                    btn.classList.add(vipCodes.includes(code) ? 'btn-warning' : 'btn-outline-light');
                                    btn.addEventListener('click', () => {
                                        btn.classList.toggle('btn-warning');
                                        btn.classList.toggle('btn-outline-light');
                                        updateVipInputFromMap();
                                    });
                                }
                                rowDiv.appendChild(btn);
                            }
                            seatMap.appendChild(rowDiv);
                        }
                    }

                    seatPreset.addEventListener('change', () => {
                        const preset = presets[seatPreset.value];
                        if (!preset) return;
                        totalSeats.value = preset.total;
                        seatsPerRow.value = preset.perRow;
                        renderSeatMap();
                    });

                    renderButton.addEventListener('click', renderSeatMap);
                    vipSeatsInput.addEventListener('blur', renderSeatMap);

                    document.addEventListener('DOMContentLoaded', () => {
                        if (totalSeats.value && seatsPerRow.value) {
                            renderSeatMap();
                        }
                    });
                </script>
            </main>
        </div>
    </div>
</body>
</html>
