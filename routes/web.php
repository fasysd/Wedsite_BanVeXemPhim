<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TicketController;
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/help/about', function () {
    return view('user.help.about');
})->name('user.help.about');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/account/general', [AccountController::class, 'show'])->middleware('auth')->name('user.account.general');
Route::get('/account/detail', [AccountController::class, 'edit'])->middleware('auth')->name('user.account.detail');
Route::put('/account/detail', [AccountController::class, 'update'])->middleware('auth')->name('user.account.detail.update');
Route::put('/account/password', [AccountController::class, 'resetPassword'])->middleware('auth')->name('user.account.password.update');
Route::get('/account/tickets', [TicketController::class, 'index'])->name('user.account.tickets');
Route::get('/account/tickets/{id}', [TicketController::class, 'show'])->name('user.account.tickets.show');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movie.show');
// ---Post routes---
Route::get('/movies/{movie}/booking', [TicketController::class, 'booking'])->name('ticket.booking')->middleware('auth');

Route::middleware(['auth', 'staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::get('/bookings', [App\Http\Controllers\StaffBookingController::class, 'index'])->name('bookings');
    Route::get('/bookings/{booking}', [App\Http\Controllers\StaffBookingController::class, 'show'])->name('bookings.show');
    Route::put('/bookings/{booking}/status', [App\Http\Controllers\StaffBookingController::class, 'updateStatus'])->name('bookings.updateStatus');

    Route::get('/tickets', [App\Http\Controllers\StaffTicketController::class, 'index'])->name('tickets');
    Route::get('/tickets/{ticket}', [App\Http\Controllers\StaffTicketController::class, 'show'])->name('tickets.show');
    Route::put('/tickets/{ticket}/status', [App\Http\Controllers\StaffTicketController::class, 'updateStatus'])->name('tickets.updateStatus');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/movies')->name('dashboard');
    Route::get('/movies', [App\Http\Controllers\AdminMovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/create', [App\Http\Controllers\AdminMovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [App\Http\Controllers\AdminMovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{movie}/edit', [App\Http\Controllers\AdminMovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [App\Http\Controllers\AdminMovieController::class, 'update'])->name('movies.update');
    Route::get('/movies/{movie}', [App\Http\Controllers\AdminMovieController::class, 'show'])->name('movies.show');
    Route::delete('/movies/{movie}', [App\Http\Controllers\AdminMovieController::class, 'destroy'])->name('movies.destroy');
    Route::view('/showtimes', 'admin.showtimes.index')->name('showtimes.index');
    Route::view('/rooms', 'admin.rooms.index')->name('rooms.index');

    Route::get('/staff', [AdminStaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [AdminStaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [AdminStaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{staff}/edit', [AdminStaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{staff}', [AdminStaffController::class, 'update'])->name('staff.update');
    Route::put('/staff/{staff}/reset-password', [AdminStaffController::class, 'resetPassword'])->name('staff.reset-password');
});
