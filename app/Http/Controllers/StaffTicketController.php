<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketDetail;

class StaffTicketController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $query = TicketDetail::with('booking.user', 'seat', 'showtime');
        if ($q) {
            $query->whereHas('booking.user', function ($u) use ($q) {
                $u->where('username', 'like', "%{$q}%")->orWhere('full_name', 'like', "%{$q}%");
            });
        }
        $tickets = $query->orderBy('id', 'desc')->get();

        return view('staff.tickets.index', compact('tickets', 'q'));
    }

    public function show(TicketDetail $ticket)
    {
        $ticket->load('booking.user', 'seat', 'showtime');
        return view('staff.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, TicketDetail $ticket)
    {
        $data = $request->validate([
            'status' => 'required|string',
        ]);
        $ticket->update(['status' => $data['status']]);
        return redirect()->back()->with('success', 'Ticket status updated');
    }
}
