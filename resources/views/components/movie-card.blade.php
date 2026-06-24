<div class="card movie-card h-100 bg-dark shadow-sm" data-id="{{ $id }}">
    <img
        src="{{ $image==null ? asset('images/movieavatar.webp') : asset($image) }}"
        class="card-img-top"
        alt="{{ $title }}"
        style="height: 200px; object-fit: cover;"
    >

    <div class="card-body d-flex flex-column">
        <h5 class="card-title fw-bold text-light">
            {{ $title }}
        </h5>

        <p class="text-secondary mb-3">
            Khởi chiếu: {{ $releaseDate }}
        </p>
        <div class="mt-auto">
            @foreach($genres as $genre)
                <span class="badge bg-primary me-1 mb-1">
                    {{ $genre }}
                </span>
            @endforeach
        </div>
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