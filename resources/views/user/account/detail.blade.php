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

                    <a href="{{ route('user.account.general') }}" class="list-group-item account-menu ">
                        Thông tin chung
                    </a>

                    <a href="{{ route('user.account.detail') }} " class="list-group-item account-menu active">
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
                        THÔNG TIN CHI TIẾT
                    </div>

                    <form>

                        <div class="row g-4">

                            <div class="col-md-6">
                                <label class="form-label">Tên người dùng</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $user->username }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>

                                <input
                                    type="email"
                                    class="form-control"
                                    value="{{ $user->email }}"
                                    disabled
                                    >
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tên đầy đủ</label>

                                <input
                                    type="text"
                                    class="form-control"
                                    value="{{ $user->full_name }}">
                            </div>

                        </div>

                        <div class="text-end mt-5">
                            <button
                                type="submit"
                                class="btn btn-save">
                                Lưu lại
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection