<?php

namespace App\Services;

use App\Enum\OrderStatus;
use Illuminate\Http\JsonResponse;

class OrderService
{
    public function store(array $order): bool
    {
        try {
            auth()->user()->orders()->create([
                'order_id' => $order['order_id'],
                'amount' => $order['total_price'],
                'status' => OrderStatus::PENDING,
            ]);
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

    public function update(string $order_id, OrderStatus $status): bool|JsonResponse
    {
        try {
            $order = auth()->user()->orders()->update([
                'status' => $status
            ])->where('order_id', $order_id)->first();

            return true;
        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
