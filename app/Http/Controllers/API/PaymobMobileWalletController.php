<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\PayOrderRequest;
use App\Services\PaymobWalletService;
use App\Traits\Wallet;
use Illuminate\Support\Facades\Http;

class PaymobMobileWalletController extends Controller
{
    use Wallet;

    public function __construct(protected PaymobWalletService $paymobWalletService){}




}


