@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ $action }}" method="POST">
    @csrf
    @if($movie->exists)
        @method('PUT')
        <input type="hidden" name="id" value="{{ $movie->id }}">
    @endif

    <div class="row g-3">
        <div class="col-md-3">
            <label class="form-label">Mã phim</label>
            @if($isEdit)
                <input type="text" class="form-control" value="{{ $movie->id }}" disabled>
            @else
                <input type="number" name="id" class="form-control" min="1" value="{{ old('id', $movie->id) }}">
                <small class="text-muted">Bỏ trống để tạo ID tự động</small>
            @endif
        </div>
        <div class="col-md-5">
            <label class="form-label">Tên phim</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Thể loại</label>
            <input type="text" name="genre" class="form-control" value="{{ old('genre', $movie->genre) }}" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Ngày phát hành</label>
            <input type="date" name="release_date" class="form-control" value="{{ old('release_date', $movie->release_date?->format('Y-m-d')) }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">Ảnh bìa (URL hoặc đường dẫn)</label>
            <input type="text" name="image_path" class="form-control" value="{{ old('image_path', $movie->image_path) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Thời lượng (phút)</label>
            <input type="number" name="duration" class="form-control" min="1" value="{{ old('duration', $movie->duration) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Ngày tạo</label>
            <input type="text" class="form-control" value="{{ $movie->created_at ? $movie->created_at->format('d/m/Y') : 'Tự động' }}" disabled>
        </div>
        <div class="col-12">
            <label class="form-label">Mô tả</label>
            <textarea name="description" class="form-control" rows="5">{{ old('description', $movie->description) }}</textarea>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Cập nhật' : 'Lưu' }}</button>
        @if($useModalCancel ?? false)
            <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">Hủy</button>
        @else
            <a href="{{ route('admin.movies.index') }}" class="btn btn-outline-light">Hủy</a>
        @endif
    </div>
</form>
