@php
    $title = 'Sửa phim';
    $action = route('admin.movies.update', $movie);
@endphp

@include('admin.movie-form')
