<?php

namespace App\Traits;

use App\Http\Requests\API\PayOrderRequest;
use App\Services\OrderService;
use App\Services\PaymobWalletService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

trait PaymobPreConnection
{
//    public function __construct(
//        protected PaymobWalletService $paymobWalletService,
//        protected OrderService $orderService
//    ){}

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
            $order = $this->paymobWalletService->getOrderItems($request->validated());

            $response = Http::withHeaders(
                $this->paymobWalletService->getUnAuthRequestHeader()
            )->post($this->base_url . '/ecommerce/orders', [
                'auth_token' => $this->auth_token,// get auth token from getAuthToken() method
                'delivery_needed' => false ,// true or false,
                'amount_cents'=> '100', // 100
                'currency'=> 'EGP', // EGP
                 'items' => $order['items'],
            ]);

            $this->order_id = $response->json()['id'];
            $this->orderService->store(  $this->order_id , $order['total_price']);
            return $this;


        }catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
    protected function getPaymentKey (): JsonResponse|string|array
    {
        try {
            $response = Http::withHeaders(
                $this->paymobWalletService->getUnAuthRequestHeader()
            )->post($this->base_url . '/acceptance/payment_keys', [
                'auth_token' => $this->auth_token, // get auth token from getAuthToken() method
                'amount_cents' => '100', // 100
                'expiration' => 3600, // 3600
                'order_id' => $this->order_id, // 878833
                'currency' => 'EGP', // EGP
                'integration_id' =>  '4104581', // 204
                'billing_data' => [
                    'first_name' => 'John', // John
                    'last_name' => 'Doe', // Doe
                    'phone_number' => '+201111111111', // +201111111111
                    'email' => 'test@gmail.com',
                    'street' => 'NA', // NA
                    'building' => 'NA', // NA
                    'floor' => 'NA', // NA
                    'apartment' => 'NA', // NA
                    'city' => 'NA', // NA
                    'country' => 'NA', // NA
                ]
            ]);
            return $response->json()['token'];
        }catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
