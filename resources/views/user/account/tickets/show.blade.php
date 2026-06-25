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


                    <div class="ticket-card">

                        {{-- Header --}}
                        <div class="ticket-header d-flex justify-content-between">

                            <div>
                                <h4 class="mb-1">
                                    {{ $ticket->showtime->movie->title ?? 'N/A' }}
                                </h4>

                                <small>
                                    Booking #{{ $ticket->booking->id }}
                                    •
                                    Ticket #{{ $ticket->id }}
                                </small>
                            </div>


                            @php
                                $status = $ticket->status;

                                $statusClass = match($status) {
                                    'HOLDING' => 'badge-warning',
                                    'BOOKED' => 'badge-success',
                                    'USED' => 'badge-info',
                                    'CANCELLED' => 'badge-danger',
                                    default => 'badge-dark'
                                };
                            @endphp


                            <span class="badge {{ $statusClass }}">
                                {{ $status }}
                            </span>

                        </div>


                        <hr>


                        {{-- Info --}}
                        <div class="ticket-body">

                            <p>
                                <strong>Suất chiếu:</strong>
                                {{ $ticket->showtime->start_time }}
                            </p>

                            <p>
                                <strong>Phòng:</strong>
                                {{ $ticket->showtime->room_id }}
                            </p>

                            <p>
                                <strong>Ghế:</strong>
                                {{ $ticket->seat->seat_row }}{{ $ticket->seat->seat_number }}
                            </p>

                            <p>
                                <strong>Giá:</strong>
                                {{ number_format($ticket->final_price,0,',','.') }}đ
                            </p>

                            {{-- Countdown chỉ xuất hiện khi trạng thái là HOLDING --}}
                            @if($status === 'HOLDING')

                            <div class="countdown-box">
                                <strong>Thời gian giữ vé:</strong>
                                <span id="countdown"></span>
                            </div>


                            <script>
                            let timer;
                            const expiredAt = new Date(
                                "{{ \Carbon\Carbon::parse($ticket->booking->expired_at)->toIso8601String() }}"
                            ).getTime();
                            function updateCountdown(){
                                const now = new Date().getTime();
                                const distance = expiredAt - now;
                                console.log("===== COUNTDOWN DEBUG =====");
                                console.log(
                                    "Expired date:",
                                    new Date(expiredAt)
                                );

                                console.log(
                                    "Expired timestamp:",
                                    expiredAt
                                );


                                console.log(
                                    "Now date:",
                                    new Date(now)
                                );

                                console.log(
                                    "Now timestamp:",
                                    now
                                );


                                console.log(
                                    "Remaining milliseconds:",
                                    distance
                                );


                                console.log(
                                    "Remaining minutes:",
                                    Math.floor(distance / 60000)
                                );


                                console.log(
                                    "Remaining seconds:",
                                    Math.floor((distance % 60000) / 1000)
                                );


                                console.log("==========================");


                                if(distance <= 0){

                                    document.getElementById('countdown').innerHTML = "Hết hạn";

                                    clearInterval(timer);

                                    // Tự động submit form hủy vé khi hết giờ
                                    const cancelForm = document.getElementById('cancel-ticket-form');
                                    if(cancelForm) {
                                        cancelForm.submit();
                                    }

                                    return;
                                }


                                const minutes = Math.floor(
                                    distance / (1000 * 60)
                                );


                                const seconds = Math.floor(
                                    (distance % (1000 * 60)) / 1000
                                );


                                document.getElementById('countdown').innerHTML =
                                    minutes + " phút " + seconds + " giây";

                            }


                            updateCountdown();

                            timer = setInterval(
                                updateCountdown,
                                1000
                            );


                            </script>

                            @endif

                        </div>



                        {{-- Footer --}}
                        <div class="ticket-footer mt-3">

                            {{-- Nếu trạng thái là HOLDING: hiển thị nút Thanh toán + nút Hủy --}}
                            @if($status === 'HOLDING')

                                <form method="POST" action="{{ route('user.account.tickets.payment', $ticket->id) }}" style="display: inline-block; margin-right: 10px;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        Thanh toán ngay
                                    </button>
                                </form>

                                {{-- Thêm id="cancel-ticket-form" để JavaScript gọi submit --}}
                                <form id="cancel-ticket-form" method="POST" action="{{ route('user.account.tickets.cancel', $ticket->id) }}" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn hủy giữ chiếc vé này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary btn-lg">
                                        Hủy giữ vé
                                    </button>
                                </form>

                            @endif

                            {{-- Nếu trạng thái là BOOKED: chỉ hiển thị nút Hủy --}}
                            @if($status === 'BOOKED')

                                <form method="POST" action="{{ route('user.account.tickets.cancel', $ticket->id) }}" onsubmit="return confirm('Bạn có chắc chắn muốn hủy chiếc vé đã đặt này?')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-lg">
                                        Hủy vé
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