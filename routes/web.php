<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TicketController;
Route::get('/login', function () {
    return view('user.login');
})->name('login');
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/help/about', function () {
    return view('user.help.about');
})->name('user.help.about');
Route::get('/register', function () {
    return view('user.register');
})->name('register');
Route::get('/account/general', function () {
    return view('user.account.general');
})->name('user.account.general');
Route::get('/account/tickets', [TicketController::class, 'index'])->name('user.account.tickets');
Route::get('/account/tickets/{id}', [TicketController::class, 'show'])->name('user.account.tickets.show');
Route::get('/account/detail', function () {
    return view('user.account.detail');
})->name('user.account.detail');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movie.show');
// ---Post routes---
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/register', [UserController::class, 'register'])->name('register.post  ');
Route::get('/movies/{movie}/booking', [TicketController::class, 'booking'])->name('ticket.booking')->middleware('auth');
