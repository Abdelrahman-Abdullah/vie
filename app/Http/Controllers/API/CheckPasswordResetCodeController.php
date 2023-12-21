<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckPasswordResetCodeRequest;
use Illuminate\Http\Request;

class CheckPasswordResetCodeController extends Controller
{
    public function __invoke(CheckPasswordResetCodeRequest $request)
    {
        # code...
    }
}
