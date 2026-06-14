@extends('layouts.app')

@section('content')
<div class="auth-page">

```
<div class="container">

    <div class="row justify-content-center g-4 align-items-stretch">

        <div class="col-lg-5 d-flex">

            <div class="auth-card w-100">

                <div class="auth-tabs">

                    <a
                        href="{{ route('login') }}"
                        class="auth-tab ajax-link">
                        ĐĂNG NHẬP
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="auth-tab active ajax-link">
                        ĐĂNG KÝ
                    </a>

                </div>

                <div class="auth-form">

                    <h2 class="register-title">
                        Tạo tài khoản CineGo
                    </h2>

                    <p class="register-subtitle">
                        Chỉ mất vài giây để bắt đầu trải nghiệm thế giới điện ảnh.
                    </p>

                    <div class="mb-3">

                        <label class="form-label">
                            Tên đăng nhập
                        </label>

                        <input
                            type="text"
                            class="form-control auth-input"
                            placeholder="Nhập tên đăng nhập">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            class="form-control auth-input"
                            placeholder="example@gmail.com">

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Mật khẩu
                        </label>

                        <input
                            type="password"
                            class="form-control auth-input"
                            placeholder="Nhập mật khẩu">

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Xác nhận mật khẩu
                        </label>

                        <input
                            type="password"
                            class="form-control auth-input"
                            placeholder="Nhập lại mật khẩu">

                    </div>

                    <button class="btn-main">
                        TẠO TÀI KHOẢN
                    </button>

                </div>

            </div>

        </div>

        <div class="col-lg-6 d-flex">

            <div class="promo-box w-100">

                <div class="promo-content">

                    <div class="promo-badge">
                        THAM GIA CINEGO
                    </div>

                    <h2 class="promo-title">
                        Bắt đầu hành trình
                        điện ảnh của bạn
                    </h2>

                    <p class="promo-desc">
                        Tạo tài khoản miễn phí để lưu phim yêu thích,
                        theo dõi lịch sử đặt vé và nhận những ưu đãi đặc biệt
                        dành riêng cho thành viên mới.
                    </p>

                    <div class="promo-stats">

                        <div>

                            <div class="promo-stat-value">
                                Miễn phí
                            </div>

                            <div class="promo-stat-label">
                                Đăng ký tài khoản
                            </div>

                        </div>

                        <div>

                            <div class="promo-stat-value">
                                500+
                            </div>

                            <div class="promo-stat-label">
                                Bộ phim hấp dẫn
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection
