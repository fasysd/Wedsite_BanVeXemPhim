<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - CineGo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.12); }
        .content-card, .section-card, .stat-card { background: #111827; border: 1px solid #1f2937; }
        .movie-thumb { width: 100%; height: 210px; object-fit: cover; border-radius: .75rem; border: 1px solid #334155; }
        .movie-poster { width: 72px; height: 100px; object-fit: cover; border-radius: .75rem; border: 1px solid #334155; }
        .form-control, .btn-outline-light, .btn-success, .btn-outline-danger, .form-select { background: #0f172a; color: #f8fafc; border-color: #334155; }
        .table-responsive { background: #ffffff; border-radius: 1rem; padding: 1rem; border: 1px solid #cbd5e1; }
        .table { color: #000000 !important; }
        .table thead th { background: #f8fafc; border-bottom: 1px solid #cbd5e1; color: #000000 !important; }
        .table tbody tr { background: #ffffff; }
        .table tbody td { border-color: #e2e8f0; color: #000000 !important; }
        .text-muted { color: #94a3b8 !important; }
        .section-title { color: #e2e8f0; }
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
                            <small class="text-muted">Trang chủ</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">A</div>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">Trang chủ</a>
                    <a class="nav-link" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                    <a class="nav-link" href="{{ route('admin.staff.index') }}">Quản lý nhân viên</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
                    </form>
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-4 flex-column flex-md-row gap-3">
                        <div>
                            <h3 class="mb-1">Trang chủ admin phim</h3>
                            <p class="text-muted mb-0">Theo dõi nhanh poster phim, phim đang chiếu và phim sắp chiếu.</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.movies.index') }}" class="btn btn-success btn-sm">Đi đến trang quản lý phim</a>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="stat-card p-3 rounded-4">
                                <small class="text-muted">Tổng phim</small>
                                <h3 class="mb-0">{{ $movies->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card p-3 rounded-4">
                                <small class="text-muted">Đang chiếu</small>
                                <h3 class="mb-0">{{ $currentShowings->count() }}</h3>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card p-3 rounded-4">
                                <small class="text-muted">Sắp chiếu</small>
                                <h3 class="mb-0">{{ $upcomingMovies->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4 mb-5">
                        <div class="col-12 col-xl-6">
                            <div class="section-card rounded-4 p-3 h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="section-title mb-0">Phim đang chiếu gần đây</h5>
                                    <span class="text-muted">{{ $currentShowings->count() }} phim</span>
                                </div>
                                <div class="row g-3">
                                    @forelse($currentShowings as $movie)
                                        <div class="col-12 col-md-6">
                                            <div class="card bg-dark border-secondary h-100">
                                                <img src="{{ $movie->image_path ?: asset('images/movieavatar.webp') }}" alt="{{ $movie->title }}" class="movie-thumb">
                                                <div class="card-body py-2 px-3">
                                                    <h6 class="mb-1 text-white">{{ $movie->title }}</h6>
                                                    <p class="small text-muted mb-1">{{ $movie->genre ?? 'Không có thể loại' }}</p>
                                                    <p class="small text-muted mb-0">Ngày chiếu: {{ $movie->release_date?->format('d/m/Y') ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="py-4 text-center text-muted">Không có phim đang chiếu hiện tại.</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-6">
                            <div class="section-card rounded-4 p-3 h-100">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="section-title mb-0">Phim sắp chiếu</h5>
                                    <span class="text-muted">{{ $upcomingMovies->count() }} phim</span>
                                </div>
                                <div class="row g-3">
                                    @forelse($upcomingMovies as $movie)
                                        <div class="col-12 col-md-6">
                                            <div class="card bg-dark border-secondary h-100">
                                                <img src="{{ $movie->image_path ?: asset('images/movieavatar.webp') }}" alt="{{ $movie->title }}" class="movie-thumb">
                                                <div class="card-body py-2 px-3">
                                                    <h6 class="mb-1 text-white">{{ $movie->title }}</h6>
                                                    <p class="small text-muted mb-1">{{ $movie->genre ?? 'Không có thể loại' }}</p>
                                                    <p class="small text-muted mb-0">Ngày chiếu: {{ $movie->release_date?->format('d/m/Y') ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="py-4 text-center text-muted">Không có phim sắp chiếu.</div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
