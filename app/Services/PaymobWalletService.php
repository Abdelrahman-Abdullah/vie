<?php

namespace App\Services;

use App\Http\Requests\API\PayOrderRequest;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PaymobWalletService
{

    public function getUnAuthRequestHeader(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }
    public function getOrderItems(array $orders): array
    {
        $items = [];
        $total_price = 0;
        foreach ($orders['items'] as $order) {
            $total_price += $order['price'];
            $items[] = [
                'name' => $order['name'],
                'amount_cents' => $order['price'] * 100,
                'description' => $order['description'],
                'quantity' => $order['quantity'] ?? 1,
            ];
        }
        return [
            'items' => $items,
            'total_price' => $total_price,
        ];
    }


}
