<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Booking;
class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //     Booking::create([
        //     [
        //         'user_id' => 1,
        //         'total_price' => 100000,
        //         'status' => 'PENDING',
        //         'expire_time' => now()->addMinutes(15),
        //     ],
        //     [
        //         'user_id' => 2,
        //         'total_price' => 150000,
        //         'status' => 'PAID',
        //         'expire_time' => null,
        //     ],
        //     [
        //         'user_id' => 3,
        //         'total_price' => 200000,
        //         'status' => 'CANCELLED',
        //         'expire_time' => null,
        //     ],
        // ]);

    }
}
