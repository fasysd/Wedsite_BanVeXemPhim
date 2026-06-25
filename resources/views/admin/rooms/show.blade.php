<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa phòng chiếu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height:100vh; background:#0f172a; border-right:1px solid #1f2937; }
        .sidebar .nav-link { color:#94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color:#f8fafc; background:rgba(14,165,233,0.12); }
        .card { background:#111827; border:1px solid #1f2937; }
        .form-control, .btn-outline-light, .btn-primary { background:#0f172a; color:#f8fafc; border-color:#334155; }
        .form-control::placeholder { color: rgba(255,255,255,0.2); opacity: 1; }
        .btn-primary { background:#0ea5e9; border-color:#0ea5e9; }
        .btn-primary:hover { background:#38bdf8; color:#0f172a; }
        .text-muted { color:#94a3b8 !important; }
        .form-control, .card, .card * { color:#f8fafc; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 sidebar p-3">
                <div class="mb-4 text-white">
                    <h5 class="mb-1">CineGo Admin</h5>
                    <small class="text-muted">Chỉnh sửa phòng chiếu mới</small>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Trang chủ</a>
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link active" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                    <a class="nav-link" href="{{ route('admin.staff.index') }}">Quản lý nhân viên</a>
                    <a class="nav-link" href="{{ route('user.account.general') }}">Xem thông tin</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
                    </form>
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div>
                        <h4 class="mb-1">Chỉnh sửa phòng chiếu</h4>
                        <p class="text-muted mb-0">
                            Cập nhật thông tin phòng và danh sách ghế VIP.
                        </p>
                    </div>
                    <a href="{{ route('admin.rooms.index') }}" class="btn btn-outline-light">Quay lại</a>
                </div>
                <div class="card p-4">
                    <div>
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">Tên phòng</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $room->name }}"
                                    readonly
                                >

                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Số dãy ghế</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    value="{{ $rowCount }}"
                                    readonly
                                >

                                @error('row_count')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Số ghế mỗi dãy</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    value="{{ $seatPerRow }}"
                                    readonly
                                >

                                @error('seat_per_row')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>

                        <div class="mt-4">
                            <h5>Xem trước sơ đồ phòng</h5>

                            <div id="room-preview" class="room-preview">
                                <p class="text-muted mb-0">
                                    Nhập số dãy ghế và số ghế mỗi dãy để xem trước.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

<script>
    const rows = {{ $rowCount }};
    const seatsPerRow = {{ $seatPerRow }};
    const preview = document.getElementById('room-preview');

    const vipSeats = new Set(@json($vipSeats));

    function renderRoom() {

        let html = `
            <div class="screen">
                MÀN HÌNH
            </div>
        `;

        for (let row = 0; row < rows; row++) {

            const rowLetter = String.fromCharCode(65 + row);

            html += '<div class="seat-row">';

            for (let seat = 1; seat <= seatsPerRow; seat++) {

                const seatCode = `${rowLetter}${seat}`;

                const vipClass =
                    vipSeats.has(seatCode)
                        ? 'vip'
                        : '';

                html += `
                    <div class="seat ${vipClass}">
                        ${seatCode}
                    </div>
                `;
            }

            html += '</div>';
        }

        html += `
            <div class="vip-legend">
                🟦 Ghế thường &nbsp;&nbsp;&nbsp;
                🟧 Ghế VIP
            </div>
        `;

        preview.innerHTML = html;
    }

    renderRoom();
</script>

</body>
</html>

<style>
.room-preview {
    margin-top: 1rem;
    padding: 1rem;
    border: 1px solid #334155;
    border-radius: 12px;
    background: #0f172a;
    overflow-x: auto;
}

.seat-row {
    display: flex;
    gap: 8px;
    margin-bottom: 10px;
    justify-content: center;
}

.seat {
    min-width: 50px;
    padding: 8px;
    text-align: center;
    border-radius: 6px;
    background: #0ea5e9;
    color: white;
    font-weight: 600;
    font-size: 14px;
    cursor: default;
    user-select: none;
    transition: all .2s;
}

.seat.vip {
    background: #f59e0b;
}

.screen {
    margin-bottom: 20px;
    padding: 10px;
    text-align: center;
    background: #334155;
    border-radius: 8px;
    font-weight: bold;
    letter-spacing: 2px;
}

.vip-legend {
    margin-top: 15px;
    color: #cbd5e1;
}
</style>
