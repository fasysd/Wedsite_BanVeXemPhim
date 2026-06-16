@extends('layouts.app')

@section('content')

@php
    $user = (object)[
        'username' => 'vandong',
        'full_name' => 'Mưu Văn Đồng',
        'email' => 'dong2000113@gmail.com'
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

                    <a href="{{ route('user.account.general') }}" class="list-group-item account-menu active">
                        Thông tin chung
                    </a>

                    <a href="{{ route('user.account.detail') }} " class="list-group-item account-menu">
                        Thông tin chi tiết
                    </a>

                    <a href="{{ route('user.account.tickets') }}" class="list-group-item account-menu">
                        Vé của tôi
                    </a>

                </div>

            </div>

            {{-- Content --}}
            <div class="col-lg-8 col-md-8">

                <div class="account-content">

                    <div class="account-header">
                        THÔNG TIN CHUNG
                    </div>

                    <div>

                        <p class="mb-3">
                            <strong>Xin chào,</strong>
                            {{ $user->username }}
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection