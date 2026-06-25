
<section class="movie-section">
    <h2 class="movie-section-title">
        {{$title}}
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
                    :genre="$movie->genre"
                />

            </div>
        @endforeach

    </div>
</section>