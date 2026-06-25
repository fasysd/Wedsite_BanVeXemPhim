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
                        CHI TIẾT VÉ
                    </div>

                    <div class="ticket-table-wrapper">
                        <p><strong>Mã vé:</strong> {{ $ticket->booking_id }}</p>
                        <p><strong>Ghế:</strong> {{ $ticket->seat_id }}</p>
                        <p><strong>Giá:</strong> {{ number_format($ticket->final_price, 0, ',', '.') }}đ</p>
                        <p><strong>Trạng thái:</strong> {{ $ticket->status }}</p>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
@endsection