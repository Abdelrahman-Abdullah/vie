<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CheckPasswordResetCodeRequest;
use App\Models\ResetPassword;
use App\Services\ResetPasswordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CheckPasswordResetCodeController extends Controller
{
    public function __construct(public ResetPasswordService $resetPasswordService)
    {
    }

    public function __invoke(CheckPasswordResetCodeRequest $request): JsonResponse
    {
        $code = $request->validated('code');
        $isCodeExist = $this->resetPasswordService->isCodeExist($code);
        $isCodeExpired = $this->resetPasswordService->isCodeExpired($code);
        if ($isCodeExist && !$isCodeExpired) {
            $isCodeExist->delete();
            return response()->json(['message' => 'Code Is Correct']);
        }
        return response()->json(['message' => 'Code Was Expired Please Try Another One..'], 400);
    }
}
