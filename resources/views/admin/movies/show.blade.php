<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Chi tiết phim - {{ $movie->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>body{background:#0d1117;color:#e5e7eb}.container{padding:24px}</style>
</head>
<body>
    <div class="container">
        <a href="{{ route('admin.movies.index') }}" class="btn btn-outline-light mb-3">Quay lại</a>
        <div class="card p-3">
            <div class="row">
                <div class="col-md-3">
                    @if($movie->image_path)
                        <img src="{{ asset('storage/' . $movie->image_path) }}" class="img-fluid" alt="{{ $movie->title }}">
                    @else
                        <img src="https://via.placeholder.com/200x300.png?text=Phim" class="img-fluid" alt="{{ $movie->title }}">
                    @endif
                </div>
                <div class="col-md-9">
                    <h2>{{ $movie->title }}</h2>
                    <p><strong>Thể loại:</strong> {{ $movie->genre }}</p>
                    <p><strong>Ngày phát hành:</strong> {{ $movie->release_date?->format('d/m/Y') }}</p>
                    <p><strong>Thời lượng:</strong> {{ $movie->duration }} phút</p>
                    <p>{{ $movie->description }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
