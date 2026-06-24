@php
    $title = 'Thêm phim mới';
    $movie = new \App\Models\Movie();
    $action = route('admin.movies.store');
@endphp

@include('admin.movie-form')
