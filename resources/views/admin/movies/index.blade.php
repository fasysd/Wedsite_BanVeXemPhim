<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý phim</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #0b1220; color: #f8fafc; }
        .sidebar { min-height: 100vh; background: #0f172a; border-right: 1px solid #1f2937; }
        .sidebar .nav-link { color: #94a3b8; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { color: #f8fafc; background: rgba(14,165,233,0.12); }
        .card, .content-card { background: #111827; border: 1px solid #1f2937; }
        .movie-poster { width:72px; height:100px; object-fit:cover; border-radius:.75rem; border:1px solid #334155; }
        .form-control, .btn-outline-light, .btn-success, .btn-outline-danger { background: #0f172a; color: #f8fafc; border-color: #334155; }
        .table-responsive { background: #ffffff; border-radius: 1rem; padding: 1rem; border: 1px solid #cbd5e1; }
        .table { color: #000000 !important; }
        .table thead th { background: #f8fafc; border-bottom: 1px solid #cbd5e1; color: #000000 !important; }
        .table tbody tr { background: #ffffff; }
        .table tbody td { border-color: #e2e8f0; color: #000000 !important; }
        .text-muted { color: #94a3b8 !important; }
        .table-hover tbody tr:hover { background: #f1f5f9; }
        .movie-detail-row { cursor: pointer; }
        .movie-detail-row td { transition: background 0.15s ease; }
        .movie-detail-row:hover td { background: #e2e8f0; }
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
                            <small class="text-muted">Quản lý phim</small>
                        </div>
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;">A</div>
                    </div>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Trang chủ</a>
                    <a class="nav-link active" href="{{ route('admin.movies.index') }}">Quản lý phim</a>
                    <a class="nav-link" href="{{ route('admin.showtimes.index') }}">Quản lý lịch chiếu</a>
                    <a class="nav-link" href="{{ route('admin.rooms.index') }}">Quản lý phòng chiếu</a>
                    <a class="nav-link" href="{{ route('admin.staff.index') }}">Quản lý nhân viên</a>
                    <a class="nav-link" href="{{ route('user.account.general') }}">Xem thông tin</a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100 text-start">Đăng xuất</button>
                    </form>
                </nav>
            </aside>
            <main class="col-lg-10 p-4">
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h4 class="mb-1">Quản lý phim</h4>
                            <p class="text-muted mb-0">Xem, tìm kiếm và quản lý phim nhanh chóng.</p>
                        </div>
                        <div class="d-flex gap-2">
                            <form action="{{ route('admin.movies.index') }}" method="GET" class="d-flex gap-2">
                                <input id="movieSearch" type="search" name="q" class="form-control form-control-sm" placeholder="Tìm theo tên phim..." style="min-width:320px;" value="{{ request('q') }}">
                                <button type="submit" class="btn btn-outline-light btn-sm">Tìm</button>
                            </form>
                            <button type="button" id="addMovieBtn" class="btn btn-success btn-sm">Thêm phim mới</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Gõ ký tự để hiển thị phim bắt đầu bằng chữ đó.</small>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <div class="content-card p-3 h-100">
                                <small class="text-muted">Tổng phim</small>
                                <h3 class="mb-0">{{ $movies->count() }}</h3>
                            </div>
                        </div>
                      
                    </div>
                    <div class="table-responsive rounded-4 shadow-sm">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" style="width:60px">ID</th>
                                    <th scope="col" style="width:120px">Ảnh</th>
                                    <th scope="col">Tên phim</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Thể loại</th>
                                    <th scope="col">Ngày chiếu</th>
                                    <th scope="col">Thời lượng</th>
                                    <th scope="col" class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($movies as $movie)
                                    <tr class="movie-detail-row" data-detail-url="{{ route('admin.movies.show', $movie) }}?modal=1">
                                        <td class="small text-muted">{{ $movie->id }}</td>
                                        <td>
                                            <img src="{{ $movie->image_path ?: asset('images/movieavatar.webp') }}" alt="{{ $movie->title }}" class="movie-poster shadow-sm" onerror="this.src='{{ asset('images/movieavatar.webp') }}';">
                                        </td>
                                        <td style="min-width:220px">
                                            <div>
                                                <strong>{{ $movie->title }}</strong>
                                                <div class="small text-muted">{{ $movie->genre ?? '-' }}</div>
                                            </div>
                                        </td>
                                        <td class="text-muted small">{{ 
                                            Illuminate\Support\Str::limit($movie->description ?? '-', 80)
                                        }}</td>
                                        <td>{{ $movie->genre ?? '-' }}</td>
                                        <td>{{ $movie->release_date?->format('d/m/Y') ?? '-' }}</td>
                                        <td>{{ $movie->duration ? $movie->duration . ' phút' : '-' }}</td>
                                        <td class="text-end">
                                            <button type="button" data-edit-url="{{ route('admin.movies.edit', $movie) }}?modal=1" class="btn btn-sm btn-outline-primary me-1 editMovieBtn">Sửa</button>
                                            <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" style="display:inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-outline-danger deleteMovieBtn" data-movie-title="{{ $movie->title }}">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">Không có phim nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <div class="modal fade" id="movieModal" tabindex="-1" aria-labelledby="movieModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="movieModalLabel"></h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="movieModalBody">
                    <div class="text-center py-5 text-muted">
                        Đang tải...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabel">Xác nhận xóa phim</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="deleteConfirmText" class="text-white"></p>
                </div>
                <div class="modal-footer border-top border-secondary-subtle">
                    <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const movieModal = new bootstrap.Modal(document.getElementById('movieModal'));
        const movieModalLabel = document.getElementById('movieModalLabel');
        const movieModalBody = document.getElementById('movieModalBody');

        async function loadMovieForm(url, title) {
            movieModalLabel.textContent = title;
            movieModalBody.innerHTML = '<div class="text-center py-5 text-muted">Đang tải...</div>';
            movieModal.show();

            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const html = await response.text();
                movieModalBody.innerHTML = html;
            } catch (error) {
                movieModalBody.innerHTML = '<div class="text-danger">Không thể tải form. Vui lòng thử lại.</div>';
            }
        }

        const movieSearchInput = document.getElementById('movieSearch');
        const movieRows = document.querySelectorAll('tbody tr');

        function filterMovieRows() {
            const query = movieSearchInput.value.trim().toLowerCase();
            movieRows.forEach(row => {
                const title = row.querySelector('td:nth-child(3) strong')?.textContent.trim().toLowerCase() || '';
                const match = query === '' || title.startsWith(query);
                row.style.display = match ? '' : 'none';
            });
        }

        movieSearchInput.addEventListener('input', filterMovieRows);

        document.getElementById('addMovieBtn').addEventListener('click', () => {
            loadMovieForm('{{ route('admin.movies.create') }}?modal=1', 'Thêm phim mới');
        });

        document.querySelectorAll('.movie-detail-row').forEach(row => {
            row.addEventListener('click', event => {
                if (event.target.closest('button') || event.target.closest('form')) {
                    return;
                }
                loadMovieForm(row.dataset.detailUrl, 'Chi tiết phim');
            });
        });

        document.querySelectorAll('.editMovieBtn').forEach(button => {
            button.addEventListener('click', event => {
                event.stopPropagation();
                loadMovieForm(button.dataset.editUrl, 'Sửa phim');
            });
        });

        const deleteConfirmModalEl = document.getElementById('deleteConfirmModal');
        const deleteConfirmModal = new bootstrap.Modal(deleteConfirmModalEl);
        const deleteConfirmText = document.getElementById('deleteConfirmText');
        const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        let deleteForm = null;

        document.querySelectorAll('.deleteMovieBtn').forEach(button => {
            button.addEventListener('click', event => {
                event.preventDefault();
                event.stopPropagation();
                deleteForm = button.closest('form');
                const title = button.dataset.movieTitle || 'bộ phim này';
                deleteConfirmText.textContent = `Bạn có chắc muốn xóa phim "${title}" không?`;
                deleteConfirmModal.show();
            });
        });

        confirmDeleteBtn.addEventListener('click', () => {
            if (deleteForm) {
                deleteForm.submit();
            }
        });
    </script>
</body>
</html>
