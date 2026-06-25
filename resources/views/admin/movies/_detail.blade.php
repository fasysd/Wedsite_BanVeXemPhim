<div class="row g-3 text-white">
    <div class="col-md-4">
        <div class="card p-3 bg-dark text-white border-secondary">
            <img src="{{ $movie->image_path ?: asset('images/movieavatar.webp') }}" alt="{{ $movie->title }}" class="img-fluid rounded-3 w-100" onerror="this.src='{{ asset('images/movieavatar.webp') }}';">
        </div>
    </div>
    <div class="col-md-8">
        <div class="card p-4 bg-dark text-white border-secondary">
            <h4 class="mb-2 text-white">{{ $movie->title }}</h4>
            <p class="text-white-50 mb-2">Thể loại: <strong class="text-white">{{ $movie->genre ?? '-' }}</strong></p>
            <p class="text-white-50 mb-2">Ngày phát hành: <strong class="text-white">{{ $movie->release_date?->format('d/m/Y') ?? '-' }}</strong></p>
            <p class="text-white-50 mb-2">Thời lượng: <strong class="text-white">{{ $movie->duration ? $movie->duration . ' phút' : '-' }}</strong></p>
            <p class="text-white-50 mb-3">Mô tả:</p>
            <p class="text-white">{{ $movie->description ?? '-' }}</p>
            <div class="mt-4">
                <p class="mb-1 text-white-50">Số lịch chiếu:</p>
                @if($movie->showtimes->count())
                    <ul class="list-group list-group-flush">
                        @foreach($movie->showtimes as $showtime)
                            <li class="list-group-item bg-dark border-secondary text-white p-2">
                                <span class="fw-bold text-white">{{ $showtime->start_time?->format('d/m/Y H:i') }} - {{ $showtime->end_time?->format('H:i') }}</span>
                                <div class="small text-white-50">Phòng #{{ $showtime->room_id }} | Giá: {{ number_format($showtime->price_standard, 0, ',', '.') }}₫</div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-white-50">Chưa có lịch chiếu.</div>
                @endif
            </div>
        </div>
    </div>
</div>
