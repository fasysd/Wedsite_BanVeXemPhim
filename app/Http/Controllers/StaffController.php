<?php

namespace App\Http\Controllers;

use App\Models\TicketDetail;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function bookings(Request $request)
    {
        $tickets = TicketDetail::with(['booking.user', 'showtime.movie', 'seat'])
            ->orderBy('id', 'desc')
            ->get();

        return view('staff.bookings', compact('tickets'));
    }

    public function tickets(Request $request)
    {
        $query = trim($request->query('q', ''));
        $ticket = null;

        if ($query !== '') {
            $ticket = TicketDetail::with(['booking.user', 'showtime.movie', 'seat'])
                ->where('id', $query)
                ->orWhereHas('booking', function ($builder) use ($query) {
                    $builder->where('id', $query);
                })
                ->first();
        }

        $tickets = TicketDetail::with(['showtime.movie', 'seat'])
            ->orderBy('id', 'desc')
            ->limit(20)
            ->get();

        $statuses = [
            'HOLDING' => 'Đang giữ',
            'BOOKED' => 'Đã xác nhận',
            'USED' => 'Đã sử dụng',
            'CANCELLED' => 'Hủy vé',
        ];

        return view('staff.tickets', compact('tickets', 'ticket', 'query', 'statuses'));
    }

    public function show(TicketDetail $ticket)
    {
        $ticket->load(['booking.user', 'showtime.movie', 'seat']);

        $statuses = [
            'HOLDING' => 'Đang giữ',
            'BOOKED' => 'Đã xác nhận',
            'USED' => 'Đã sử dụng',
            'CANCELLED' => 'Hủy vé',
        ];

        return view('staff.tickets.show', compact('ticket', 'statuses'));
    }

    public function updateStatus(Request $request, TicketDetail $ticket)
    {
        $validated = $request->validate([
            'status' => ['required', Rule::in(array_keys([
                'HOLDING' => 'Đang giữ',
                'BOOKED' => 'Đã xác nhận',
                'USED' => 'Đã sử dụng',
                'CANCELLED' => 'Hủy vé',
            ]))],
        ]);

        $ticket->update(['status' => $validated['status']]);

        return redirect()
            ->route('staff.tickets.show', $ticket)
            ->with('success', 'Đã cập nhật trạng thái vé.');
    }
}
