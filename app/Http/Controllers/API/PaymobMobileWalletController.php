<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\PayOrderRequest;
use App\Services\OrderService;
use App\Services\PaymobWalletService;
use App\Traits\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class PaymobMobileWalletController extends Controller
{
    use Wallet;

    public function __construct(protected PaymobWalletService $paymobWalletService, protected OrderService $orderService){}

    public function __invoke(PayOrderRequest $request): JsonResponse|string
    {

        try {
            $payment_token = $this->getAuthToken()
                ->orderRegistration($request)
                ->getPaymentKey();

            $response = Http::withHeaders(
                $this->paymobWalletService->getUnAuthRequestHeader()
            )->post($this->base_url . '/acceptance/payments/pay',[
                'source' => [
                    'identifier' => $request->validated('phone_number'),
                    'subtype' => 'WALLET',
                ],
                'payment_token' => $payment_token,
            ]);
            return $response->json()['redirect_url'];
        }catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

    }


}


