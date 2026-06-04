<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        // Movie::truncate();

        Movie::insert([
            [
                'title' => 'Avengers: Endgame',
                'duration' => 181,
                'release_date' => '2019-04-26',
                'genre' => 'Action',
                'description' => 'Marvel movie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dune Part Two',
                'duration' => 166,
                'release_date' => '2024-03-01',
                'genre' => 'Sci-Fi',
                'description' => 'Dune movie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Inside Out 2',
                'duration' => 96,
                'release_date' => '2024-06-14',
                'genre' => 'Animation',
                'description' => 'Pixar animation movie',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}