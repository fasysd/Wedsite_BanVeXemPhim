<?php

namespace App\Http\Controllers;
use  App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getExpireTime(int $id)
    {
    //     return Booking::where('id', $id)
    //    ->where('status', 'PENDING')
    //    ->first()?->expired_at;
    }
}
