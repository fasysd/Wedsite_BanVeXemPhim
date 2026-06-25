@extends('layouts.app')

@section('content')
<div class="container-fluid movie-index-page p-0 d-flex flex-column justify-content-start align-items-center">
    <div class="container-fluid vh-120 text-center text-dark p-0 row" style="background-color: #00c16a;">
        <h2 > ĐẶT VÉ ONLINE </h2>
    </div>
    @include('seat.index', ['seats' => $seats])
    <div class="container-fluid bg-black text-white py-3 border-bottom border-primary">
    <div class="d-flex align-items-center justify-content-between">

        {{-- Previous --}}
        <div>
            <button onclick="history.back()" class="btn btn-danger rounded-4 px-4 py-3">
                ← PREVIOUS
            </button>
        </div>

        {{-- Nội dung giữa --}}
        <div class="d-flex align-items-center flex-grow-1 justify-content-evenly">

            {{-- Poster --}}
            <div>
                <img
                    src="{{ $movie->image_path }}"
                    alt="{{ $movie->title }}"
                    style="width:80px;height:120px;object-fit:cover;"
                    onerror="this.onerror=null;this.src='{{ asset('images/movieavatar.webp') }}';"
                >
            </div>

            {{-- Thông tin phim --}}
            <div>
                @if(!empty($movie->title))
                    <div class="fw-bold text-uppercase">
                        {{ $movie->title }}
                    </div>
                @endif

                @if(!empty($movie->genre))
                    <div>{{ $movie->genre }}</div>
                @endif

                @if(!empty($movie->duration))
                    <div>{{ $movie->duration }} phút</div>
                @endif
            </div>

            {{-- Thông tin suất chiếu --}}
            <div>
                @if(!empty($showtime->start_time))
                    <div>
                        <span class="text-secondary">Suất chiếu:</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                        </strong>
                    </div>

                    <div>
                        <span class="text-secondary">Ngày:</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($showtime->start_time)->format('d/m/Y') }}
                        </strong>
                    </div>
                @endif

                @if(!empty($showtime->room_id))
                    <div>
                        <span class="text-secondary">Phòng:</span>
                        <strong>{{ $showtime->room_id }}</strong>
                    </div>
                @endif
            </div>

            {{-- Thông tin đơn hàng --}}
            <div>
                <div>
                    Tên phim:
                    <strong>{{ $movie->title }}</strong>
                </div>

                <div>
                    Ghế:
                    <strong id="selectedSeats">0</strong>
                </div>

                <div>
                    Tổng:
                    <strong id="totalPrice">0 đ</strong>
                </div>
            </div>

        </div>

        {{-- Next --}}
        <div>
            <button class="btn btn-danger rounded-4 px-5 py-3">
                NEXT →
            </button>
        </div>

    </div>
</div>
</div>
@endsection