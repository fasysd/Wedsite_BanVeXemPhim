@extends('layouts.app')

@section('content')
<div>
    <h1>Purchase Result</h1>
    <p>Your ticket has been purchased successfully!</p>
    <button class="btn btn-primary" onclick="window.location.href='{{ route('user.account.tickets') }}'">View My Tickets</button>
    <button class="btn btn-secondary" onclick="window.location.href='{{ route('movie.index') }}'">Back to Movies</button>
</div>