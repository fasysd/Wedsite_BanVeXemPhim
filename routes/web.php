<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
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
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movie.show');

Route::get('/movies/{movie}/booking', [TicketController::class, 'booking'])
    ->middleware('auth')
    ->name('ticket.booking');

Route::get('/help/about', function () {
    return view('user.help.about');
})->name('user.help.about');

Route::get('/welcome', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ACCOUNT
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
| STAFF (GIỮ NGUYÊN, KHÔNG ĐỔI NAME/URI)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {
        Route::view('/bookings', 'staff.bookings')->name('bookings');
        Route::view('/tickets', 'staff.tickets')->name('tickets');
    });

/*
|--------------------------------------------------------------------------
| ADMIN (GIỮ NGUYÊN, KHÔNG ĐỔI NAME/URI)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::redirect('/', '/admin/movies')->name('dashboard');

        Route::view('/movies', 'admin.movies.index')->name('movies.index');
        Route::view('/showtimes', 'admin.showtimes.index')->name('showtimes.index');
        Route::view('/rooms', 'admin.rooms.index')->name('rooms.index');

        Route::get('/staff', [AdminStaffController::class, 'index'])->name('staff.index');
        Route::get('/staff/create', [AdminStaffController::class, 'create'])->name('staff.create');
        Route::post('/staff', [AdminStaffController::class, 'store'])->name('staff.store');
        Route::get('/staff/{staff}/edit', [AdminStaffController::class, 'edit'])->name('staff.edit');
        Route::put('/staff/{staff}', [AdminStaffController::class, 'update'])->name('staff.update');
        Route::put('/staff/{staff}/reset-password', [AdminStaffController::class, 'resetPassword'])->name('staff.reset-password');
    });