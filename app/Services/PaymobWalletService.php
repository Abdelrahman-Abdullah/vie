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



}
