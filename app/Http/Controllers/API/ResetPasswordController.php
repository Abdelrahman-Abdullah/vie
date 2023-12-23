<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ResetPasswordRequest;
use App\Services\ResetPasswordService;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __construct(public ResetPasswordService $resetPasswordService){}
    public function __invoke(ResetPasswordRequest $request)
    {

    }
}
