@extends('layouts.app')

@section('content')
@php
    $slides = [
        'https://picsum.photos/1200/400?random=11',
        'https://picsum.photos/1200/400?random=12',
        'https://picsum.photos/1200/400?random=13',
    ];

    foreach($movies as $movie) {
        $movie->genres = explode(',', $movie->genre);
        $movie->image_path = asset('images/movieavatar.webp');
    }
@endphp

<div class="container-fluid movie-index-page text-dark p-0">

    {{-- =======================
         BANNER FULL WIDTH
    ======================== --}}
    <section class="banner-section">

        <div id="homeBanner"
             class="carousel slide"
             data-bs-ride="carousel"
             data-bs-interval="3000">

            <div class="carousel-inner">

                @foreach($slides as $index => $slide)

                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">

                        <img
                            src="{{ $slide }}"
                            class="d-block w-100 banner-image"
                            alt="Banner">

                    </div>

                @endforeach

            </div>

            <button
                class="carousel-control-prev banner-nav"
                type="button"
                data-bs-target="#homeBanner"
                data-bs-slide="prev">

                <span class="carousel-control-prev-icon"></span>

            </button>

            <button
                class="carousel-control-next banner-nav"
                type="button"
                data-bs-target="#homeBanner"
                data-bs-slide="next">

                <span class="carousel-control-next-icon"></span>

            </button>

            <div class="carousel-indicators">

                @foreach($slides as $index => $slide)

                    <button
                        type="button"
                        data-bs-target="#homeBanner"
                        data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}">
                    </button>

                @endforeach

            </div>

        </div>

    </section>

    {{-- =======================
         MOVIE CONTENT
    ======================== --}}
    <div class="container py-5">

        <section class="movie-section">

            <h2 class="movie-section-title">
                Phim đang chiếu tại CineGo
            </h2>

            <div class="movie-row">

                @foreach($movies as $movie)
                    @if($loop->index == 5) 
                        @break
                    @endif
                    <div class="movie-item">
                        <x-movie-card
                            :id="$movie->id"
                            :image="$movie->image_path"
                            :title="$movie->title"
                            :release-date="$movie->release_date"
                            :genres="$movie->genres"
                        />

                    </div>

                @endforeach

            </div>

        </section>

        <section class="movie-section">

            <h2 class="movie-section-title">
                Gợi ý cho bạn
            </h2>

            <div class="movie-row">
              
                @foreach($movies as $movie)
                @if($loop->index == 4) 
                        @break
                    @endif
                    <div class="movie-item">

                        <x-movie-card
                            :id="$movie->id"
                            :image="$movie->image_path"
                            :title="$movie->title"
                            :release-date="$movie->release_date"
                            :genres="$movie->genres"
                        />

                    </div>

                @endforeach

            </div>

        </section>

        <section class="movie-section">

            <h2 class="movie-section-title">
                Phim sắp khởi chiếu
            </h2>

            <div class="movie-row">
                @foreach($movies as $movie)
                    @if($loop->index == 4) 
                            @break
                        @endif
                    <div class="movie-item">

                        <x-movie-card
                            :id="$movie->id"
                            :image="$movie->image_path"
                            :title="$movie->title"
                            :release-date="$movie->release_date"
                            :genres="$movie->genres"
                        />

                    </div>

                @endforeach

            </div>

        </section>

    </div>

</div>
<script>
    document.querySelectorAll('.movie-card').forEach(row => {
        row.addEventListener('click', () => {
            const ticketId = row.getAttribute('data-id');
            if (ticketId) {
                window.location.href = `/movies/${ticketId}`;
            }
        });
    });
</script>
@endsection