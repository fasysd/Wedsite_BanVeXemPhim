<?php

namespace App\Http\Controllers;

<<<<<<< HEAD
use App\Models\TicketDetail;
use Illuminate\Http\Request;
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
    public function purchase(Request $request, $id)
    {
        $seats = $request->seat_id; 
        dd($seats);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
=======
use Illuminate\Http\Request;

class TicketController extends Controller
{
        /*
        Thực hiện:
            Danh sách vé của tôi
            Chi tiết vé
    */
>>>>>>> 88d971248a68e63241063d0580672aebbd6d6d6c
}
