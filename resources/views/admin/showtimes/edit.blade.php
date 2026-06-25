<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm lịch chiếu mới</title>
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
        .form-control option {
            color: #000;
            background: #fff;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 sidebar p-3">
                <div class="mb-4 text-white">
                    <h5 class="mb-1">CineGo Admin</h5>
                    <small class="text-muted">Thêm lịch chiếu mới</small>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                    <div>
                        <h4 class="mb-1">Thêm lịch chiếu mới</h4>
                    </div>
                </div>
                <div class="card p-4">
                    <form action="{{ route('admin.showtimes.update', $showtime->id) }}"method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Phim</label>
                                <select
                                    class="form-control"
                                    id="movieSelect"
                                    name="movie_id"
                                    required>

                                    @foreach($movies as $movie)
                                        <option
                                            value="{{ $movie->id }}"
                                            data-duration="{{ $movie->duration }}"
                                            data-genre="{{ $movie->genre }}"
                                            data-release="{{ $movie->release_date?->format('d/m/Y') }}"
                                            {{ old('movie_id', $showtime->movie_id) == $movie->id ? 'selected' : '' }}
                                        >
                                            {{ $movie->title }}
                                        </option>
                                    @endforeach

                                </select>
                                <div id="movieInfo" class="mt-2 small text-light">
                                    Chưa chọn phim
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Phòng chiếu</label>
                                <select
                                    class="form-control"
                                    id="roomSelect"
                                    name="room_id"
                                    required>

                                    @foreach($rooms as $room)
                                        <option
                                            value="{{ $room->id }}"
                                            data-seats="{{ $room->total_seats }}"
                                            data-vip-seats="{{ $room->getVipSeatCount() }}"
                                            {{ old('room_id', $showtime->room_id) == $room->id ? 'selected' : '' }}
                                        >
                                            {{ $room->name }}
                                        </option>
                                    @endforeach

                                </select>
                                <div id="roomInfo" class="mt-2 small text-light">
                                    Chưa chọn phòng
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bắt đầu</label>
                                <input
                                    type="datetime-local"
                                    id="startTime"
                                    name="start_time"
                                    class="form-control"
                                    value="{{ old('start_time', \Carbon\Carbon::parse($showtime->start_time)->format('Y-m-d\TH:i')) }}"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kết thúc</label>
                                <input
                                    type="datetime-local"
                                    id="endTime"
                                    name="end_time"
                                    class="form-control"
                                    value="{{ old('end_time', \Carbon\Carbon::parse($showtime->end_time)->format('Y-m-d\TH:i')) }}"
                                    readonly>
                            <div class="col-md-12">
                                <label class="form-label">Giá vé chuẩn</label>
                                <input
                                    type="number"
                                    name="price_standard"
                                    class="form-control"
                                    min="0"
                                    value="{{ old('price_standard', $showtime->price_standard) }}"
                                    required>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                Cập nhật
                            </button>

                            <a href="{{ route('admin.showtimes.index') }}"
                            class="btn btn-outline-light">
                                Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>

<script>
    const movieSelect = document.getElementById('movieSelect');
    const roomSelect = document.getElementById('roomSelect');

    movieSelect.addEventListener('change', function () {

        const option = this.options[this.selectedIndex];

        if (!this.value) {
            document.getElementById('movieInfo').innerHTML =
                'Chưa chọn phim';
            return;
        }

        document.getElementById('movieInfo').innerHTML = `
            <strong>Thời lượng:</strong> ${option.dataset.duration} phút<br>
            <strong>Thể loại:</strong> ${option.dataset.genre}<br>
            <strong>Khởi chiếu:</strong> ${option.dataset.release}
        `;

        updateEndTime();
    });

    document
        .getElementById('startTime')
        .addEventListener('change', updateEndTime);

    roomSelect.addEventListener('change', function () {

        const option = this.options[this.selectedIndex];

        if (!this.value) {
            document.getElementById('roomInfo').innerHTML =
                'Chưa chọn phòng';
            return;
        }

        document.getElementById('roomInfo').innerHTML = `
            <strong>Tổng số ghế:</strong> ${option.dataset.seats}<br>
            <strong>Số ghế VIP:</strong> ${option.dataset.vipSeats}
        `;
    });

    function roundUpToTenMinutes(date) {

        const minutes = date.getMinutes();

        const roundedMinutes = Math.ceil(minutes / 10) * 10;

        date.setMinutes(roundedMinutes);

        date.setSeconds(0);
        date.setMilliseconds(0);

        return date;
    }

    function updateEndTime() {

        const movieOption =
            movieSelect.options[movieSelect.selectedIndex];

        const startValue =
            document.getElementById('startTime').value;

        if (!movieSelect.value || !startValue) {
            return;
        }

        const duration =
            parseInt(movieOption.dataset.duration);

        const endDate = new Date(startValue);

        endDate.setMinutes(
            endDate.getMinutes() + duration
        );

        roundUpToTenMinutes(endDate);

        document.getElementById('endTime').value =
            formatDateTimeLocal(endDate);
    }

    function getDefaultStartTime() {

        const now = new Date();

        const minutes = now.getMinutes();

        if (minutes === 0 || minutes === 30) {
            // đã đúng mốc
        }
        else if (minutes < 30) {
            now.setMinutes(30);
        }
        else {
            now.setHours(now.getHours() + 1);
            now.setMinutes(0);
        }

        now.setSeconds(0);
        now.setMilliseconds(0);

        return now;
    }

    function formatDateTimeLocal(date) {
        const offset = date.getTimezoneOffset();
        const localDate = new Date(date.getTime() - offset * 60000);

        return localDate.toISOString().slice(0, 16);
    }

    document.addEventListener('DOMContentLoaded', () => {

        const startInput = document.getElementById('startTime');
        
        if (movieSelect.value) {
            movieSelect.dispatchEvent(new Event('change'));
        }

        if (roomSelect.value) {
            roomSelect.dispatchEvent(new Event('change'));
        }

        if (!startInput.value) {

            const defaultTime = getDefaultStartTime();

            startInput.value = formatDateTimeLocal(defaultTime);
        }
    });

</script>

</body>
</html>
