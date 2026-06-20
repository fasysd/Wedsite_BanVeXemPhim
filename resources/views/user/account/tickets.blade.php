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

                    <a href="{{ route('user.account.detail') }} " class="list-group-item account-menu">
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
                                <tr >
                                    <th>Vé</th>
                                    <th>Ngày đặt</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if($tickets->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            Bạn chưa có vé nào.
                                        </td>
                                    </tr>
                                @endif
                                @foreach($tickets as $ticket)
                                    <tr class="ticket-row" data-id="{{ $ticket->id }}">
                                        <td>{{ $ticket->booking_id }}</td>
                                        <td>{{ $ticket->seat_id }}</td>
                                        <td>{{ number_format($ticket->final_price, 0, ',', '.') }}đ</td>
                                        <td>
                                            <span class="ticket-status">
                                                {{ $ticket->status }}
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
    // Thêm sự kiện click cho các hàng vé
    document.querySelectorAll('.ticket-row').forEach(row => {
        row.addEventListener('click', () => {
            const id = row.getAttribute('data-id');
            window.location.href = `/account/tickets/${id}`; // Chuyển hướng đến trang chi tiết vé
        });
    });
</script>

@endsection