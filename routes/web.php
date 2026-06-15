<?php

use Illuminate\Support\Facades\Route;

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
