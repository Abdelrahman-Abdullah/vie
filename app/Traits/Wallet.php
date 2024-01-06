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

}
