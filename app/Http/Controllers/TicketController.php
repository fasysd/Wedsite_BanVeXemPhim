<?php

namespace App\Http\Controllers;

use App\Models\TicketDetail;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Showtime;
class TicketController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = TicketDetail::all();
        return view('user.account.tickets', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function booking(Movie $movie)
    {
        $seats = Seat::all();
        $showtime = Showtime::where('movie_id', $movie->id)->first();
        return view('movie.booking', ['movie' => $movie, 'seats' => $seats, 'showtime' => $showtime] );
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketDetail $ticketDetail)
    {
        $ticketDetail->save();
        return redirect()->route('user.account.tickets')->with('success', 'Ticket purchased successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = TicketDetail::findOrFail($id);
        return view('user.account.tickets.show', compact('ticket'));
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
