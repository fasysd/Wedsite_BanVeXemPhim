@extends('layouts.app')

@section('content')
<div class="container-fluid movie-index-page text-dark p-0">
    <p>>Trang chi tiết phim</p>
    <p>Phim: {{ $movie->title }}</p>
    <p>Ngày phát hành: {{ $movie->release_date }}</p>
    <p>Thể loại: {{ $movie->genre }}</p>
    <p>Mô tả: {{ $movie->description }}</p>
    <button class="btn btn-primary" id="bookBtn">Đặt vé</button>
</div>
<script>
   document.getElementById('bookBtn').addEventListener('click', () => {
    fetch('/movies/{{ $movie->id }}/purchase', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .content
                
        },
        body: JSON.stringify({
            seat_id: 1, // Giả sử người dùng chọn ghế có ID 1 
            showtime_id: 2,
            status: 'HOLDING'
        })
    });
});
</script>
@endsection