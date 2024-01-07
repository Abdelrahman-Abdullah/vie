<?php

namespace App\Services;

use App\Enum\OrderStatus;

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
}
