<?php

namespace App\Http\Controllers;

use App\Services\RoomService;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    private RoomService $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    /**
     * Danh sách phòng
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => $this->roomService->getAllRooms()
        ]);
    }

    /**
     * Form thêm phòng
     */
    public function create()
    {
        return response()->json([
            'message' => 'Create room page'
        ]);
    }

    /**
     * Thêm phòng
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'row_count' => 'required|integer|min:1|max:26',
            'seat_per_row' => 'required|integer|min:1',
        ]);

        $result = $this->roomService->createRoom([
            'name' => $request->name,
            'row_count' => $request->row_count,
            'seat_per_row' => $request->seat_per_row,
        ]);

        if ($result === RoomService::ERROR_DUPLICATE_NAME) {
            return response()->json([
                'success' => false,
                'message' => 'Tên phòng đã tồn tại.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    /**
     * Xem thông tin phòng
     */
    public function edit(int $id)
    {
        return response()->json([
            'success' => true,
            'data' => $this->roomService->getRoomById($id)
        ]);
    }

    /**
     * Cập nhật phòng
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'row_count' => 'required|integer|min:1|max:26',
            'seat_per_row' => 'required|integer|min:1',
        ]);

        $result = $this->roomService->updateRoom(
            $id,
            [
                'name' => $request->name,
                'row_count' => $request->row_count,
                'seat_per_row' => $request->seat_per_row,
            ]
        );

        switch ($result) {

            case RoomService::ERROR_DUPLICATE_NAME:
                return response()->json([
                    'success' => false,
                    'message' => 'Tên phòng đã tồn tại.'
                ], 422);

            case RoomService::ERROR_HAS_SHOWTIMES:
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể sửa phòng đang có suất chiếu trong tương lai.'
                ], 422);
        }

        return response()->json([
            'success' => true,
            'data' => $result
        ]);
    }

    /**
     * Xóa phòng
     */
    public function destroy(int $id)
    {
        $result = $this->roomService->deleteRoom($id);

        if ($result === RoomService::ERROR_HAS_SHOWTIMES) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa phòng đang có suất chiếu trong tương lai.'
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Xóa phòng thành công.'
        ]);
    }
}