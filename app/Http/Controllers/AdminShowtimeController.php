<?php

namespace App\Http\Controllers;

use App\Services\ShowtimeService;
use Illuminate\Http\Request;

class AdminShowtimeController extends Controller
{
    private ShowtimeService $showtimeService;

    public function __construct(ShowtimeService $showtimeService)
    {
        $this->showtimeService = $showtimeService;
    }

    /**
     * Danh sách suất chiếu
     */
    public function index()
    {
        return response()->json(
            $this->showtimeService->getAllShowtimes()
        );
    }

    /**
     * Form thêm suất chiếu
     */
    public function create()
    {
        return response()->json([
            'message' => 'Create showtime page'
        ]);
    }

    /**
     * Thêm suất chiếu
     */
    public function store(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|integer',
            'room_id' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'price_standard' => 'required|numeric|min:0'
        ]);

        $result = $this->showtimeService->createShowtime([
            'movie_id' => $request->movie_id,
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'price_standard' => $request->price_standard
        ]);

        switch ($result) {
            case ShowtimeService::ERROR_START_TIME:
                return response()->json([
                    'success' => false,
                    'message' => 'Thời gian bắt đầu phải ở tương lai.'
                ], 422);

            case ShowtimeService::ERROR_DURATION:
                return response()->json([
                    'success' => false,
                    'message' => 'Thời lượng suất chiếu ngắn hơn thời lượng phim.'
                ], 422);

            case ShowtimeService::ERROR_CONFLICT:
                return response()->json([
                    'success' => false,
                    'message' => 'Phòng đã có suất chiếu trong khoảng thời gian này.'
                ], 422);
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    /**
     * Xem thông tin suất chiếu
     */
    public function edit(int $id)
    {
        return response()->json(
            $this->showtimeService->getShowtimeById($id)
        );
    }

    /**
     * Cập nhật suất chiếu
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'movie_id' => 'required|integer',
            'room_id' => 'required|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'price_standard' => 'required|numeric|min:0'
        ]);

        $result = $this->showtimeService->updateShowtime(
            $id,
            [
                'movie_id' => $request->movie_id,
                'room_id' => $request->room_id,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'price_standard' => $request->price_standard
            ]
        );

        switch ($result) {
            case ShowtimeService::ERROR_START_TIME:
                return response()->json([
                    'success' => false,
                    'message' => 'Thời gian bắt đầu phải ở tương lai.'
                ], 422);

            case ShowtimeService::ERROR_DURATION:
                return response()->json([
                    'success' => false,
                    'message' => 'Thời lượng suất chiếu ngắn hơn thời lượng phim.'
                ], 422);

            case ShowtimeService::ERROR_CONFLICT:
                return response()->json([
                    'success' => false,
                    'message' => 'Phòng đã có suất chiếu trong khoảng thời gian này.'
                ], 422);

            case ShowtimeService::ERROR_HAS_TICKETS:
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể sửa suất chiếu đã có vé.'
                ], 422);
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    /**
     * Xóa suất chiếu
     */
    public function destroy(int $id)
    {
        $result = $this->showtimeService->deleteShowtime($id);

        if ($result === ShowtimeService::ERROR_HAS_TICKETS) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa suất chiếu đã có vé.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }
}