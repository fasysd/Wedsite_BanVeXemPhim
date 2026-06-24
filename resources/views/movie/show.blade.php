@extends('layouts.app')
@section('content')
@php
    use App\Http\Controllers\MovieController;
    $suggestedMovies = MovieController::getSuggestedMovies();
@endphp
<div class="movie-detail-container">
    <div class="movie-poster">
        <img src="{{ asset('images/movieavatar.webp') }}" alt="{{ $movie->title }}">
    </div>
    <div class="movie-info">
        <h1>{{ $movie->title }}</h1>

        <div class="info-item">
            <span>Thời lượng:</span>
            <span>{{ $movie->duration }} phút</span>
        </div>
        <div class="info-item">
            <span>Ngày khởi chiếu:</span>
            <span>{{ $movie->release_date }}</span>
        </div>

        <div class="info-item">
            <span>Thể loại:</span>
            <span>{{ $movie->genre }}</span>
        </div>

        <div class="info-item mt-4">
            {{ $movie->description }}
        </div>
        <button class="btn-book" id="bookBtn">
            Đặt vé
        </button>
    </div>
</div>
<div class="container-fluid movie-index-page text-dark p-0">
    <div class="container py-5">
        <x-movie-suggestion-layout :movies="$suggestedMovies" title="Có thể bạn cũng thích" />
    </div>
</div>
<script>
document.getElementById('bookBtn').addEventListener('click', () => {
    @guest
        window.location.href = "{{ route('login') }}";
    @endguest
    @auth
        window.location.href = "{{ route('ticket.booking', ['movie' => $movie->id]) }}";
    @endauth
    // fetch('/movies/{{ $movie->id }}/purchase', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': document
    //             .querySelector('meta[name="csrf-token"]')
    //             .content
    //     },
    //     body: JSON.stringify({
    //         seat_id: 1,
    //         showtime_id: 2,
    //         status: 'HOLDING'
    //     })
    // }).then(async response => {

    //     if (!response.ok) {
    //         const errors = await response.json();

    //         for (const field in errors) {
    //             alert(errors[field][0]);
    //         }

    //         return;
    //     }

    //     alert('Đặt vé thành công!');
    // });
});
</script>
@endsection