<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\Room;
use App\Models\Showtime;
use Carbon\Carbon;

class ShowtimeService
{
    public const ERROR_START_TIME = 'INVALID_START_TIME';
    public const ERROR_DURATION = 'INVALID_DURATION';
    public const ERROR_CONFLICT = 'ROOM_SCHEDULE_CONFLICT';
    public const ERROR_HAS_TICKETS = 'HAS_TICKETS';

    /**
     * Lấy tất cả suất chiếu
     */
    public function getAllShowtimes()
    {
        return Showtime::with(['movie', 'room'])
            ->orderBy('start_time')
            ->get();
    }

    /**
     * Lấy suất chiếu theo id
     */
    public function getShowtimeById(int $id)
    {
        return Showtime::with(['movie', 'room'])
            ->findOrFail($id);
    }

    /**
     * Tạo suất chiếu
     */
    public function createShowtime(array $data)
    {
        $movie = Movie::findOrFail($data['movie_id']);

        Room::findOrFail($data['room_id']);

        $startTime = Carbon::parse($data['start_time']);
        $endTime = Carbon::parse($data['end_time']);

        if (!$this->validateStartTime($startTime)) {
            return self::ERROR_START_TIME;
        }

        if (
            !$this->validateShowtimeDuration(
                $startTime,
                $endTime,
                $movie->duration
            )
        ) {
            return self::ERROR_DURATION;
        }

        if (
            !$this->validateRoomSchedule(
                $data['room_id'],
                $startTime,
                $endTime
            )
        ) {
            return self::ERROR_CONFLICT;
        }

        return Showtime::create([
            'movie_id' => $data['movie_id'],
            'room_id' => $data['room_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'price_standard' => $data['price_standard'],
        ]);
    }

    /**
     * Cập nhật suất chiếu
     */
    public function updateShowtime(int $id, array $data)
    {
        $showtime = Showtime::findOrFail($id);

        if (!$this->validateNoTicketsExist($showtime)) {
            return self::ERROR_HAS_TICKETS;
        }

        $movie = Movie::findOrFail($data['movie_id']);

        Room::findOrFail($data['room_id']);

        $startTime = Carbon::parse($data['start_time']);
        $endTime = Carbon::parse($data['end_time']);

        if (!$this->validateStartTime($startTime)) {
            return self::ERROR_START_TIME;
        }

        if (
            !$this->validateShowtimeDuration(
                $startTime,
                $endTime,
                $movie->duration
            )
        ) {
            return self::ERROR_DURATION;
        }

        if (
            !$this->validateRoomSchedule(
                $data['room_id'],
                $startTime,
                $endTime,
                $id
            )
        ) {
            return self::ERROR_CONFLICT;
        }

        $showtime->update([
            'movie_id' => $data['movie_id'],
            'room_id' => $data['room_id'],
            'start_time' => $startTime,
            'end_time' => $endTime,
            'price_standard' => $data['price_standard'],
        ]);

        return $showtime->fresh();
    }

    /**
     * Xóa suất chiếu
     */
    public function deleteShowtime(int $id)
    {
        $showtime = Showtime::findOrFail($id);

        if (!$this->validateNoTicketsExist($showtime)) {
            return self::ERROR_HAS_TICKETS;
        }

        return $showtime->delete();
    }

    /**
     * Kiểm tra lịch chiếu có bị trùng trong cùng phòng hay không
     */
    private function validateRoomSchedule(
        int $roomId,
        Carbon $startTime,
        Carbon $endTime,
        ?int $ignoreShowtimeId = null
    ): bool {
        $query = Showtime::where('room_id', $roomId);

        if ($ignoreShowtimeId !== null) {
            $query->where('id', '!=', $ignoreShowtimeId);
        }

        $conflict = $query
            ->where(function ($q) use ($startTime, $endTime) {
                $q->where('start_time', '<', $endTime)
                    ->where('end_time', '>', $startTime);
            })
            ->exists();

        return !$conflict;
    }

    /**
     * Kiểm tra thời lượng suất chiếu
     */
    private function validateShowtimeDuration(
        Carbon $startTime,
        Carbon $endTime,
        int $movieDuration
    ): bool {
        if (!$endTime->greaterThan($startTime)) {
            return false;
        }

        return $startTime->diffInMinutes($endTime) >= $movieDuration;
    }

    /**
     * Kiểm tra thời gian bắt đầu
     */
    private function validateStartTime(
        Carbon $startTime
    ): bool {
        return !$startTime->isPast();
    }

    /**
     * Không cho sửa/xóa nếu đã có vé
     */
    private function validateNoTicketsExist(
        Showtime $showtime
    ): bool {
        return !$showtime->ticketDetails()->exists();
    }
}