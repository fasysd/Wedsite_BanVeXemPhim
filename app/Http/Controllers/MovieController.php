<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Movie;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check() && Auth::user()->role === 'ADMIN') {
            return redirect()->route('admin.dashboard');
        }

        $movies = Movie::all();
        return view('user.index', compact('movies'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public static function getSuggestedMovies()
    {
        $movies = Movie::all();
        return $movies;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $movie = Movie::findOrFail($id);
        return view('movie.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
