<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BookingSeeder::class,
            MovieSeeder::class,
            RoomSeeder::class,
            SeatSeeder::class,
            ShowtimeSeeder::class,
            TicketSeeder::class,
        ]);
    }
}