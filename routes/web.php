<?php

use Illuminate\Support\Facades\Route;

//Testing ----------------------------------
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminShowtimeController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| TEST ADMIN ROOM CONTROLLER
|--------------------------------------------------------------------------
*/

// Danh sách phòng
Route::get('/test/room/create-success', function (
    AdminRoomController $controller
) {
    return $controller->destroy(1);
});
//----------------------------------------------

Route::get('/login', function () {
    return view('user.login');
})->name('login');
Route::get('/', function () {
    return view('user.index');
})->name('user.index');
Route::get('/help/about', function () {
    return view('user.help.about');
})->name('user.help.about');
Route::get('/register', function () {
    return view('user.register');
})->name('register');
Route::get('/account/general', function () {
    return view('user.account.general');
})->name('user.account.general');
Route::get('/account/tickets', function () {
    return view('user.account.tickets');
})->name('user.account.tickets');
Route::get('/account/detail', function () {
    return view('user.account.detail');
})->name('user.account.detail');
Route::get('/welcome', function () {
    return view('welcome');
});

Route::view('/admin', 'admin')->name('admin.dashboard');
Route::view('/admin/movies', 'admin.movies.index')->name('admin.movies.index');
Route::view('/admin/showtimes', 'admin.showtimes.index')->name('admin.showtimes.index');
Route::view('/admin/rooms', 'admin.rooms.index')->name('admin.rooms.index');

Route::redirect('/staff', '/staff/bookings');
Route::view('/staff/bookings', 'staff.bookings')->name('staff.bookings');
Route::view('/staff/tickets', 'staff.tickets')->name('staff.tickets');
