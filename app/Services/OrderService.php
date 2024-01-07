<?php

namespace App\Services;

use App\Enum\OrderStatus;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class OrderService
{
    public function store(string $order_id, string $total_price): bool
    {
        try {
            auth()->user()->orders()->create([
                'order_id' => $order_id,
                'amount' => $total_price,
                'status' => OrderStatus::PENDING,
            ]);
            return true;
        } catch (\Exception $e) {
            Log::error('Order creation failed: ' . $e->getMessage());
            return false;
            // Add more specific information to the log if needed
        }

    }

    public function update(string $order_id, OrderStatus $status): bool|JsonResponse
    {
        try {
            Order::where('order_id', $order_id)->update([
                'status' => $status
            ]);
            return true;
        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
