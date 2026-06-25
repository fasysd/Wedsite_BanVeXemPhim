@extends('layouts.app')

@section('content')
<div class="account-page">

    <div class="container py-5">

        <div class="row justify-content-center">

            {{-- Sidebar --}}
            <div class="col-lg-3 col-md-4 mb-4">

                <h3 class="account-title">
                    TÀI KHOẢN CineGo
                </h3>

                <div class="list-group">

                    <a href="{{ route('user.account.general') }}" class="list-group-item account-menu">
                        Thông tin chung
                    </a>

                    <a href="{{ route('user.account.detail') }}" class="list-group-item account-menu">
                        Thông tin chi tiết
                    </a>

                    <a href="{{ route('user.account.tickets') }}" class="list-group-item account-menu active">
                        Vé của tôi
                    </a>

                </div>

            </div>

            {{-- Content --}}
            <div class="col-lg-8 col-md-8">

                <div class="account-content">

                    <div class="account-header">
                        CHI TIẾT VÉ
                    </div>

                    {{-- TICKET CARD --}}
                    <div class="ticket-card">

                        {{-- HEADER --}}
                        <div class="ticket-header">
                            <div>
                                <h4 class="mb-1">
                                    {{ $ticket->showtime->movie->title ?? 'N/A' }}
                                </h4>
                                <small>
                                    Booking #{{ $ticket->booking->id }} • Ticket #{{ $ticket->id }}
                                </small>
                            </div>

                            <div>
                                @php
                                    $status = $ticket->booking->status;

                                    $statusClass = match($status) {
                                        'PENDING' => 'badge-warning',
                                        'PAID' => 'badge-success',
                                        'CANCELLED' => 'badge-danger',
                                        'EXPIRED' => 'badge-secondary',
                                        default => 'badge-dark'
                                    };
                                @endphp

                                <span class="badge {{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </div>
                        </div>

                        <hr>

                        {{-- BODY INFO --}}
                        <div class="ticket-body">

                            <p><strong>Suất chiếu:</strong> {{ $ticket->showtime->start_time }}</p>
                            <p><strong>Phòng:</strong> {{ $ticket->showtime->room_id }}</p>

                            <p><strong>Ghế:</strong>
                                {{ $ticket->seat->seat_row }}{{ $ticket->seat->seat_number }}
                            </p>

                            <p><strong>Giá:</strong>
                                {{ number_format($ticket->final_price, 0, ',', '.') }}đ
                            </p>

                            {{-- Countdown --}}
                            @if($ticket->booking->status === 'PENDING')
                                <div class="countdown-box">
                                    <strong>Thời gian giữ vé:</strong>
                                    <span id="countdown"></span>
                                </div>

                                <script>
                                    const expireAt = {{ $ticket->booking->expire_at * 1000 }};

                                    function updateCountdown() {
                                        const now = new Date().getTime();
                                        const distance = expireAt - now;

                                        if (distance <= 0) {
                                            document.getElementById("countdown").innerHTML = "Hết hạn";
                                            return;
                                        }

                                        const minutes = Math.floor(distance / 60000);
                                        const seconds = Math.floor((distance % 60000) / 1000);

                                        document.getElementById("countdown").innerHTML =
                                            minutes + "m " + seconds + "s";
                                    }

                                    updateCountdown();
                                    setInterval(updateCountdown, 1000);
                                </script>
                            @endif

                        </div>

                        {{-- FOOTER ACTION --}}
                        <div class="ticket-footer">

                            @if($ticket->booking->status === 'PENDING')
                                {{-- <form method="POST" action="{{ route('ticket.pay', $ticket->booking->id) }}"> --}}
                                    <form>
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        Thanh toán ngay
                                    </button>
                                </form>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection