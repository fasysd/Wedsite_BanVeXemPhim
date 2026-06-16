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
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 sidebar p-3">
                <div class="mb-4 text-white">
                    <h5 class="mb-1">CineGo Admin</h5>
                    <small class="text-muted">Quản lý lịch chiếu</small>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Dashboard</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                    <a class="nav-link active" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="mb-1">{{ $title }}</h4>
                        <p class="text-muted mb-0">Thiết lập thời gian và giá vé cho phim theo từng phòng.</p>
                    </div>
                    <a href="{{ route('admin.showtimes.index') }}" class="btn btn-outline-light">Quay lại</a>
                </div>
                <div class="card p-4">
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $showtime->id }}">
                        @if($showtime->exists)
                            @method('PUT')
                        @endif
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Phim</label>
                                <select name="movie_id" class="form-control" required>
                                    <option value="">Chọn phim</option>
                                    @foreach($movies as $movie)
                                        <option value="{{ $movie->id }}" {{ old('movie_id', $showtime->movie_id) == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Phòng chiếu</label>
                                <select name="room_id" class="form-control" required>
                                    <option value="">Chọn phòng</option>
                                    @foreach($rooms as $room)
                                        <option value="{{ $room->id }}" {{ old('room_id', $showtime->room_id) == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Bắt đầu</label>
                                <input type="datetime-local" name="start_time" class="form-control" value="{{ old('start_time', $showtime->start_time?->format('Y-m-d\TH:i')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kết thúc</label>
                                <input type="datetime-local" name="end_time" class="form-control" value="{{ old('end_time', $showtime->end_time?->format('Y-m-d\TH:i')) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Giá vé chuẩn</label>
                                <input type="number" name="price_standard" class="form-control" min="0" step="0.01" value="{{ old('price_standard', $showtime->price_standard) }}" required>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Lưu lịch chiếu</button>
                        </div>
                    </form>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
