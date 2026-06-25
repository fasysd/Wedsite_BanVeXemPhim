<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminMovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::withCount('showtimes')
            ->when($request->query('q'), function ($query, $q) {
                return $query->where('title', 'like', "%{$q}%")
                    ->orWhere('genre', 'like', "%{$q}%");
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.movies.index', compact('movies'));
    }

    public function create(Request $request)
    {
        $movie = new Movie();
        $viewData = [
            'movie' => $movie,
            'title' => 'Thêm phim mới',
            'action' => route('admin.movies.store'),
            'method' => 'POST',
            'isEdit' => false,
            'useModalCancel' => (bool) $request->query('modal'),
        ];

        if ($request->query('modal')) {
            return view('admin.movies._form', $viewData);
        }

        return view('admin.movie-form', $viewData);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => ['nullable', 'integer', 'min:1', 'unique:movies,id'],
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:255'],
            'release_date' => ['nullable', 'date'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
        ]);

        if (empty($validated['id'])) {
            unset($validated['id']);
        }

        Movie::create($validated);

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Đã thêm phim mới.');
    }

    public function edit(Request $request, Movie $movie)
    {
        $viewData = [
            'movie' => $movie,
            'title' => 'Sửa phim',
            'action' => route('admin.movies.update', $movie),
            'method' => 'PUT',
            'isEdit' => true,
            'useModalCancel' => (bool) $request->query('modal'),
        ];

        if ($request->query('modal')) {
            return view('admin.movies._form', $viewData);
        }

        return view('admin.movie-form', $viewData);
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'id' => ['nullable', 'integer', 'min:1', Rule::unique('movies', 'id')->ignore($movie->id)],
            'title' => ['required', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:255'],
            'release_date' => ['nullable', 'date'],
            'image_path' => ['nullable', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
        ]);

        unset($validated['id']);
        $movie->update($validated);

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Đã cập nhật phim.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()
            ->route('admin.movies.index')
            ->with('success', 'Đã xóa phim.');
    }
}
