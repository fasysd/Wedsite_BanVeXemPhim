@extends('layouts.app')

@section('content')

@php
    $user = (object)[
        'username' => 'vandong',
        'full_name' => 'Mưu Văn Đồng',
        'email' => 'dong2000113@gmail.com'
    ];
    $tickets = [
    (object)[
        'movie' => 'Avengers: Endgame',
        'date' => '15/06/2026 19:30',
        'price' => '120.000đ',
        'status' => 'Đã thanh toán'
    ],
    (object)[
        'movie' => 'Spider-Man: No Way Home',
        'date' => '12/06/2026 20:00',
        'price' => '100.000đ',
        'status' => 'Đã sử dụng'
    ],
    (object)[
        'movie' => 'The Batman',
        'date' => '10/06/2026 18:45',
        'price' => '110.000đ',
        'status' => 'Đã hủy'
    ],
    (object)[
        'movie' => 'Interstellar',
        'date' => '08/06/2026 21:00',
        'price' => '150.000đ',
        'status' => 'Đã thanh toán'
    ],
];
@endphp

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
                                <tr>
                                    <th>Vé</th>
                                    <th>Ngày đặt</th>
                                    <th>Giá</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($tickets as $ticket)
                                    <tr>
                                        <td>{{ $ticket->movie }}</td>
                                        <td>{{ $ticket->date }}</td>
                                        <td>{{ $ticket->price }}</td>
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

@endsection