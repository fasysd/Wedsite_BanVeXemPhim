<?php

namespace App\Http\Controllers;

use App\Models\TicketDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
class TicketController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = TicketDetail::with(['booking', 'seat', 'showtime.movie'])
        ->whereHas('booking', function ($q) {
            $q->where('user_id', auth()->id());
        })
        ->get();
        return view('user.account.tickets', compact('tickets'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function booking(Request $request, Movie $movie)
    {
        $showtimes = Showtime::where('movie_id', $movie->id)
            ->orderBy('start_time')
            ->get();

        if ($showtimes->isEmpty()) {
            return redirect()->route('movie.show', $movie->id)
                ->with('error', 'Phim chưa có suất chiếu.');
        }

        $selectedShowtimeId = $request->query('showtime')
            ?? $showtimes->first()->id;

        $selectedShowtime = $showtimes->firstWhere('id', $selectedShowtimeId);

        if (!$selectedShowtime) {
            abort(404, 'Suất chiếu không tồn tại');
        }

        $seats = Seat::where('room_id', $selectedShowtime->room_id)
            ->orderBy('seat_row')
            ->orderBy('seat_number')
            ->get();

        // Lấy các ghế đã có vé của suất chiếu này
        $tickets = TicketDetail::where('showtime_id', $selectedShowtime->id)
            ->get(['seat_id', 'status']);

        $holdingSeatIds = $tickets
            ->where('status', 'HOLDING')
            ->pluck('seat_id')
            ->toArray();

        $bookedSeatIds = $tickets
            ->where('status', 'BOOKED')
            ->pluck('seat_id')
            ->toArray();

        return view('movie.booking', [
            'movie' => $movie,
            'showtimes' => $showtimes,
            'selectedShowtime' => $selectedShowtime,
            'seats' => $seats,
            'holdingSeatIds' => $holdingSeatIds,
            'bookedSeatIds' => $bookedSeatIds,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request, Movie $movie)
{

    DB::transaction(function () use ($request) {

        $seatIds = $request->input('seat_ids');

        $showtime = Showtime::findOrFail($request->showtime_id);


        $booking = Booking::create([

            'user_id' => Auth::id(),

            'total_price' => count($seatIds) * $showtime->price_standard,

            'status' => 'PENDING',

            'expired_at' => now()->addMinutes(10)

        ]);
        foreach($seatIds as $seatId){

            TicketDetail::create([

                'booking_id' => $booking->id,

                'showtime_id' => $showtime->id,

                'seat_id' => $seatId,

                'final_price' => $showtime->price_standard,

                'status' => 'HOLDING'

            ]);

        }


    });
     return redirect()
    ->route('ticket.result');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = TicketDetail::findOrFail($id);
        return view('user.account.tickets.show', compact('ticket'));
    }
    public function purchase(Request $request, Movie $movie)
    {
        $showtime = Showtime::findOrFail($request->showtime_id);
        $seatIds = explode(',', $request->seat_ids);
        $selectedSeats = Seat::whereIn('id', $seatIds)->get();
        Log::info($selectedSeats);
        return view('movie.purchase', compact(
            'movie',
            'showtime',
            'selectedSeats'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
