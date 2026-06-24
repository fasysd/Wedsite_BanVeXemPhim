<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminShowtimeController;
use Illuminate\Http\Request;

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
    return view('home.index');
});

Route::view('/admin', 'admin')->name('admin.dashboard');

Route::view('/admin/movies', 'admin.movies.index')->name('admin.movies.index');

Route::get('/admin/rooms', [AdminRoomController::class, 'index'])
    ->name('admin.rooms.index');
Route::get('/admin/rooms/create', [AdminRoomController::class, 'create'])
    ->name('admin.rooms.create');
Route::post('/admin/rooms', [AdminRoomController::class, 'store'])
    ->name('admin.rooms.store');
Route::get('/admin/rooms/{id}/edit', [AdminRoomController::class, 'edit'])
    ->name('admin.rooms.edit');
Route::get('/admin/rooms/{id}', [AdminRoomController::class, 'show'])
    ->name('admin.rooms.show');
Route::put('/admin/rooms/{id}', [AdminRoomController::class, 'update'])
    ->name('admin.rooms.update');
Route::delete('/admin/rooms/{id}', [AdminRoomController::class, 'destroy'])
    ->name('admin.rooms.destroy');

Route::get('/admin/showtimes', [AdminShowtimeController::class, 'index'])
    ->name('admin.showtimes.index');
Route::get('/admin/showtimes/create', [AdminShowtimeController::class, 'create'])
    ->name('admin.showtimes.create');
Route::post('/admin/showtimes', [AdminShowtimeController::class, 'store'])
    ->name('admin.showtimes.store');
Route::get('/admin/showtimes/{id}/edit', [AdminShowtimeController::class, 'edit'])
    ->name('admin.showtimes.edit');
Route::get('/admin/showtimes/{id}', [AdminShowtimeController::class, 'show'])
    ->name('admin.showtimes.show');
Route::put('/admin/showtimes/{id}', [AdminShowtimeController::class, 'update'])
    ->name('admin.showtimes.update');
Route::delete('/admin/showtimes/{id}', [AdminShowtimeController::class, 'destroy'])
    ->name('admin.showtimes.destroy');


Route::redirect('/staff', '/staff/bookings');
Route::view('/staff/bookings', 'staff.bookings')->name('staff.bookings');
Route::view('/staff/tickets', 'staff.tickets')->name('staff.tickets');
