<?php

namespace App\Http\Controllers\API;

use App\Enum\OrderStatus;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PaymentStatusController extends Controller
{
    public function __construct(protected OrderService $orderService){}

    public function __invoke(Request $request): JsonResponse
    {
        if ($request->success == 'success') {
            $this->orderService->update($request->order->id, OrderStatus::PAID);
            return response()->json([
                'message' => 'Payment is done successfully'
            ], 200);
        }
        $this->orderService->update($request->order->id, OrderStatus::FAILED);
        return response()->json([
            'message' => 'Payment is failed'
        ], 500);
    }
}
