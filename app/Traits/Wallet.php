<?php

namespace App\Traits;

use App\Http\Requests\API\PayOrderRequest;
use App\Services\PaymobWalletService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

trait Wallet
{
    public function __construct(protected PaymobWalletService $paymobWalletService){}

    protected string $base_url = 'https://accept.paymob.com/api';
    protected string $auth_token;
    protected string $order_id;
    protected function getAuthToken(): string|static|JsonResponse
    {
        try {
            $auth_token_response = Http::withHeaders([
                $this->paymobWalletService->getUnAuthRequestHeader()
            ])->post($this->base_url . '/auth/tokens', [
                'api_key' => env('PAYMOB_API_KEY'),
            ]);

             $this->auth_token = $auth_token_response->json()['token'];
             return $this;

        }catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
    protected function orderRegistration(PayOrderRequest $request): bool|static|JsonResponse
    {
        try {
            $order_items = $this->paymobWalletService->getOrderItems($request->validated());

            $response = Http::withHeaders(
                $this->paymobWalletService->getUnAuthRequestHeader()
            )->post($this->base_url . '/ecommerce/orders', [
                'auth_token' => $this->auth_token,// get auth token from getAuthToken() method
                'delivery_needed' => false ,// true or false,
                'amount_cents'=> '100', // 100
                'currency'=> 'EGP', // EGP
                 'items' => $order_items,
            ]);

            $this->order_id = $response->json()['id'];
            return $this;


        }catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
