<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class StaffBookingController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $query = Booking::with('user');
        if ($q) {
            $query->whereHas('user', function ($u) use ($q) {
                $u->where('username', 'like', "%{$q}%")->orWhere('full_name', 'like', "%{$q}%");
            });
        }
        $bookings = $query->orderBy('id', 'desc')->get();

        return view('staff.bookings.index', compact('bookings', 'q'));
    }

    public function show(Booking $booking)
    {
        $booking->load('ticketDetails.seat', 'user');
        return view('staff.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'status' => 'required|string',
        ]);
        $booking->update(['status' => $data['status']]);
        return redirect()->back()->with('success', 'Booking status updated');
    }
}
