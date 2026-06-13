<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Cần có
    Trang chủ
    Đăng nhập
    Đăng ký
    Phim
    Lịch chiếu
    Đặt vé
    Admin
*/