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
                        VÉ CỦA TÔI
                    </div>

                    <div class="ticket-table-wrapper">

                        <table class="ticket-table">

                            <thead>
                                <tr>
                                    <th>Mã vé</th>
                                    <th>Phim / Suất chiếu</th>
                                    <th>Ghế</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>

                            <tbody>

                                @if($tickets->isEmpty())
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            Bạn chưa có vé nào.
                                        </td>
                                    </tr>
                                @endif

                                @foreach($tickets as $ticket)

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

                                    <tr class="ticket-row" data-id="{{ $ticket->id }}" style="cursor: pointer;">

                                        <td>
                                            #{{ $ticket->id }}
                                        </td>

                                        <td>
                                            <div>
                                                <strong>{{ $ticket->showtime->movie->title ?? 'N/A' }}</strong>
                                            </div>
                                            <small>
                                                {{ $ticket->showtime->start_time ?? '' }}
                                            </small>
                                        </td>

                                        <td>
                                            {{ $ticket->seat->seat_row }}{{ $ticket->seat->seat_number }}
                                        </td>

                                        <td>
                                            {{ number_format($ticket->final_price, 0, ',', '.') }}đ
                                        </td>

                                        <td>
                                            <span class="ticket-status {{ $statusClass }}">
                                                {{ $status }}
                                            </span>
                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
document.querySelectorAll('.ticket-row').forEach(row => {
    row.addEventListener('click', () => {
        const id = row.getAttribute('data-id');
        window.location.href = `/account/tickets/${id}`;
    });
});
</script>
@endsection