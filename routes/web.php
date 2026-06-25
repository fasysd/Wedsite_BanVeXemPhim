<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\AdminRoomController;
use App\Http\Controllers\AdminShowtimeController;
use App\Http\Controllers\AdminMovieController;
use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('user.index');
})->name('user.index');

Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movie.show');

Route::get('/movies/{movie}/booking', [TicketController::class, 'booking'])
    ->middleware('auth')
    ->name('ticket.booking');

Route::get('/help/about', function () {
    return view('user.help.about');
})->name('user.help.about');

Route::get('/welcome', function () {
    return view('home.index');
});

/*
|--------------------------------------------------------------------------
| ACCOUNT (USER)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/account/general', [AccountController::class, 'show'])
        ->name('user.account.general');

    Route::get('/account/detail', [AccountController::class, 'edit'])
        ->name('user.account.detail');

    Route::put('/account/detail', [AccountController::class, 'update'])
        ->name('user.account.detail.update');

    Route::put('/account/password', [AccountController::class, 'resetPassword'])
        ->name('user.account.password.update');

    Route::get('/account/tickets', [TicketController::class, 'index'])
        ->name('user.account.tickets');

    Route::get('/account/tickets/{id}', [TicketController::class, 'show'])
        ->name('user.account.tickets.show');
});

/*
|--------------------------------------------------------------------------
| STAFF
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        | Dashboard
        */
        Route::redirect('/', '/admin/rooms')->name('admin.dashboard');

        /*
        | Movies
        */
        Route::view('/movies', 'admin.movies.index')
            ->name('movies.index');

        /*
        | Rooms
        */
        Route::get('/rooms', [AdminRoomController::class, 'index'])
            ->name('rooms.index');

        Route::get('/rooms/create', [AdminRoomController::class, 'create'])
            ->name('rooms.create');

        Route::post('/rooms', [AdminRoomController::class, 'store'])
            ->name('rooms.store');

        Route::get('/rooms/{id}/edit', [AdminRoomController::class, 'edit'])
            ->name('rooms.edit');

        Route::get('/rooms/{id}', [AdminRoomController::class, 'show'])
            ->name('rooms.show');

        Route::put('/rooms/{id}', [AdminRoomController::class, 'update'])
            ->name('rooms.update');

        Route::delete('/rooms/{id}', [AdminRoomController::class, 'destroy'])
            ->name('rooms.destroy');

        /*
        | Showtimes
        */
        Route::get('/showtimes', [AdminShowtimeController::class, 'index'])
            ->name('showtimes.index');

        Route::get('/showtimes/create', [AdminShowtimeController::class, 'create'])
            ->name('showtimes.create');

        Route::post('/showtimes', [AdminShowtimeController::class, 'store'])
            ->name('showtimes.store');

        Route::get('/showtimes/{id}', [AdminShowtimeController::class, 'show'])
            ->name('showtimes.show');

        Route::get('/showtimes/{id}/edit', [AdminShowtimeController::class, 'edit'])
            ->name('showtimes.edit');

        Route::put('/showtimes/{id}', [AdminShowtimeController::class, 'update'])
            ->name('showtimes.update');

        Route::delete('/showtimes/{id}', [AdminShowtimeController::class, 'destroy'])
            ->name('showtimes.destroy');

        /*
        | Staff
        */
        Route::get('/staff', [AdminStaffController::class, 'index'])
            ->name('staff.index');

        Route::get('/staff/create', [AdminStaffController::class, 'create'])
            ->name('staff.create');

        Route::post('/staff', [AdminStaffController::class, 'store'])
            ->name('staff.store');

        Route::get('/staff/{staff}/edit', [AdminStaffController::class, 'edit'])
            ->name('staff.edit');

        Route::put('/staff/{staff}', [AdminStaffController::class, 'update'])
            ->name('staff.update');

        Route::put('/staff/{staff}/reset-password', [AdminStaffController::class, 'reset-password'])
            ->name('staff.reset-password');
    });
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
    Route::get('/bookings', [StaffController::class, 'bookings'])->name('bookings');
    Route::get('/tickets', [StaffController::class, 'tickets'])->name('tickets');
    Route::get('/tickets/{ticket}', [StaffController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/status', [StaffController::class, 'updateStatus'])->name('tickets.updateStatus');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminMovieController::class, 'home'])->name('dashboard');
    Route::get('/movies', [AdminMovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/create', [AdminMovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [AdminMovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{movie}', [AdminMovieController::class, 'show'])->name('movies.show');
    Route::get('/movies/{movie}/edit', [AdminMovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [AdminMovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{movie}', [AdminMovieController::class, 'destroy'])->name('movies.destroy');
    Route::view('/showtimes', 'admin.showtimes.index')->name('showtimes.index');
    Route::view('/rooms', 'admin.rooms.index')->name('rooms.index');

    Route::get('/staff', [AdminStaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [AdminStaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [AdminStaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{staff}/edit', [AdminStaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{staff}', [AdminStaffController::class, 'update'])->name('staff.update');
    Route::put('/staff/{staff}/reset-password', [AdminStaffController::class, 'resetPassword'])->name('staff.reset-password');
});
