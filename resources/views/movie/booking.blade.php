@extends('layouts.app')

@section('content')
<div class="container-fluid movie-index-page p-0 d-flex flex-column justify-content-start align-items-center">

    {{-- Header --}}
    <div class="container-fluid text-center p-0 row" style="background-color: #00c16a;">
        <h2>ĐẶT VÉ ONLINE</h2>
    </div>

    {{-- Chọn suất + sơ đồ ghế --}}
    <div class="container-fluid px-4 mt-0">

        <div class="row mb-100">

            {{-- Cột trái: Suất chiếu --}}
            <div class="col-lg-3 col-md-12 mb-4 d-flex justify-content-end border-end border-secondary">

                <div class="showtime-wrapper">

                    <h4 class="text-white mb-4">
                        Chọn suất chiếu
                    </h4>

                    @php
                        $groupedShowtimes = $showtimes->groupBy('room_id');
                    @endphp

                    @foreach($groupedShowtimes as $roomId => $roomShowtimes)

                        <div class="mb-4">

                            <h5 class="text-white">
                                Phòng {{ $roomId }}
                            </h5>

                            <div class="d-flex flex-wrap gap-2 mt-2">

                                @foreach($roomShowtimes as $showtime)

                                    <a
                                        href="{{ route('ticket.booking', $movie->id) }}?showtime={{ $showtime->id }}"
                                        class="btn {{ $selectedShowtime->id == $showtime->id ? 'btn-light text-dark' : 'btn-outline-light' }}"
                                    >
                                        {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}
                                    </a>

                                @endforeach

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

            {{-- Cột phải: Màn hình + ghế --}}
            <div class="col-lg-9 col-md-12">

                <div class="screen-arc d-flex justify-content-center align-items-center flex-column mb-4">

                    <h2 class="text-white mb-3">
                        MÀN HÌNH
                    </h2>

                    <svg viewBox="0 0 400 40">
                        <path d="M20 30 Q200 -10 380 30" />
                    </svg>

                </div>

                @include('seat.index', ['seats' => $seats])

            </div>

        </div>

    </div>

    {{-- Thanh thông tin dưới cùng --}}
    <div class="container-fluid bg-black row  text-white py-3 border-bottom border-primary">

        <div class="d-flex align-items-center justify-content-between">

            {{-- Previous --}}
            <div>
                <a href="{{ route('movie.show', $movie->id) }}"
                   class="btn btn-danger text-center"
                   style="width:150px;height:50px;">
                    &lt; Trang trước
                </a>
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
                        <div>
                            {{ $movie->genre }}
                        </div>
                    @endif

                    @if(!empty($movie->duration))
                        <div>
                            {{ $movie->duration }} phút
                        </div>
                    @endif

                </div>

                {{-- Thông tin suất chiếu --}}
                <div>

                    <div>
                        <span class="text-secondary">Suất chiếu:</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($selectedShowtime->start_time)->format('H:i') }}
                        </strong>
                    </div>

                    <div>
                        <span class="text-secondary">Ngày:</span>
                        <strong>
                            {{ \Carbon\Carbon::parse($selectedShowtime->start_time)->format('d/m/Y') }}
                        </strong>
                    </div>

                    <div>
                        <span class="text-secondary">Phòng:</span>
                        <strong>
                            {{ $selectedShowtime->room_id }}
                        </strong>
                    </div>

                </div>

                {{-- Thông tin đơn hàng --}}
                <div>

                    <div>
                        Tên phim:
                        <strong>{{ $movie->title }}</strong>
                    </div>

                    <div>
                        Số ghế:
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
                <form action="{{ route('ticket.purchase', $movie->id) }}" method="POST" id="bookingForm">
                    @csrf

                    <input type="hidden" name="showtime_id" value="{{ $selectedShowtime->id }}">
                    <input type="hidden" name="seat_ids" id="seat_ids">

                    <button
                        type="submit"
                        class="btn btn-danger"
                        id="continueBtn"
                        style="display:none;"
                    >
                        Tiếp tục >
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>
<script>
    const form = document.getElementById('bookingForm');
    const continueBtn = document.getElementById('continueBtn');

    function updateContinueButton() {
        if (selectedSeatIds.length > 0) {
            continueBtn.style.display = 'inline-block';
        } else {
            continueBtn.style.display = 'none';
        }
    }

    form.addEventListener('submit', function () {
        document.getElementById('seat_ids').value =
            selectedSeatIds.join(',');
    });

    // Gọi lần đầu
    updateContinueButton();
</script>
@endsection