<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/admin', 'admin')->name('admin.dashboard');
Route::view('/admin/movies', 'admin.movies.index')->name('admin.movies.index');
Route::view('/admin/showtimes', 'admin.showtimes.index')->name('admin.showtimes.index');
Route::view('/admin/rooms', 'admin.rooms.index')->name('admin.rooms.index');

Route::redirect('/staff', '/staff/bookings');
Route::view('/staff/bookings', 'staff.bookings')->name('staff.bookings');
Route::view('/staff/tickets', 'staff.tickets')->name('staff.tickets');
