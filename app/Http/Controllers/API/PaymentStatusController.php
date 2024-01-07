<?php

namespace App\Http\Controllers\API;

use App\Enum\OrderStatus;
use App\Http\Controllers\Controller;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentStatusController extends Controller
{
    public function __construct(protected OrderService $orderService)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            if ($request->success === 'true') {
                $this->orderService->update($request->order, OrderStatus::PAID);
                $responseMessage = 'Payment is successful';
            } else {
                $this->orderService->update($request->order, OrderStatus::FAILED);
                $responseMessage = 'Payment is failed';
            }

            return response()->json(['message' => $responseMessage], 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'Payment is failed '.$e->getMessage()], 500);
        }

    }
}
