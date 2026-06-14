@extends('layouts.app')

@section('content')
<div class="auth-page">

    <div class="container">

        <div class="row justify-content-center g-4 align-items-stretch">

            <div class="col-lg-5 d-flex">

                <div class="auth-card w-100">

                    <div class="auth-tabs">

                        <a
                            href="{{ route('login') }}"
                            class="auth-tab active ajax-link">
                            ĐĂNG NHẬP
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="auth-tab ajax-link">
                            ĐĂNG KÝ
                        </a>

                    </div>

                    <div class="auth-form">

                        <h2 class="login-title">
                            Chào mừng trở lại
                        </h2>

                        <p class="login-subtitle">
                            Đăng nhập để đặt vé, quản lý giao dịch
                            và nhận ưu đãi thành viên CineGo.
                        </p>

                        <div class="mb-4">

                            <label class="form-label">
                                Tên đăng nhập
                            </label>

                            <input
                                type="text"
                                class="form-control auth-input"
                                placeholder="Nhập tên đăng nhập">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Mật khẩu
                            </label>

                            <input
                                type="password"
                                class="form-control auth-input"
                                placeholder="Nhập mật khẩu">

                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">

                            <div class="form-check">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="remember">

                                <label
                                    class="form-check-label"
                                    for="remember">
                                    Ghi nhớ đăng nhập
                                </label>

                            </div>

                            <a href="#" class="forgot-link">
                                Quên mật khẩu?
                            </a>

                        </div>

                        <button class="btn-main">
                            ĐĂNG NHẬP
                        </button>

                    </div>

                </div>

            </div>

            <div class="col-lg-6 d-flex">

                <div class="promo-box w-100">

                    <div class="promo-content">

                        <div class="promo-badge">
                            THÀNH VIÊN CINEGO+
                        </div>

                        <h2 class="promo-title">
                            Đặt vé nhanh hơn,
                            nhận ưu đãi nhiều hơn
                        </h2>

                        <p class="promo-desc">
                            Trải nghiệm hệ thống đặt vé hiện đại,
                            lưu lịch sử giao dịch, theo dõi các bộ phim yêu thích
                            và nhận những chương trình khuyến mãi độc quyền dành
                            riêng cho thành viên CineGo.
                        </p>

                        <div class="promo-stats">

                            <div>

                                <div class="promo-stat-value">
                                    500+
                                </div>

                                <div class="promo-stat-label">
                                    Bộ phim
                                </div>

                            </div>

                            <div>

                                <div class="promo-stat-value">
                                    1M+
                                </div>

                                <div class="promo-stat-label">
                                    Thành viên
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection