<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class AdminMovieController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        if ($q) {
            $movies = Movie::where('title', 'like', "%{$q}%")->orderBy('id', 'desc')->get();
        } else {
            $movies = Movie::orderBy('id', 'desc')->get();
        }

        return view('admin.movies.index', compact('movies', 'q'));
    }

    public function create()
    {
        return view('admin.movies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'nullable|integer',
            'release_date' => 'nullable|date',
            'genre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('movies', 'public');
            $data['image_path'] = $path;
        }

        Movie::create($data);

        return redirect()->route('admin.movies.index')->with('success', 'Movie created');
    }

    public function show(Movie $movie)
    {
        return view('admin.movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'nullable|integer',
            'release_date' => 'nullable|date',
            'genre' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('movies', 'public');
            // delete old
            if ($movie->image_path) {
                Storage::disk('public')->delete($movie->image_path);
            }
            $data['image_path'] = $path;
        }

        $movie->update($data);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated');
    }

    public function destroy(Movie $movie)
    {
        if ($movie->image_path) {
            Storage::disk('public')->delete($movie->image_path);
        }
        $movie->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted');
    }
}
