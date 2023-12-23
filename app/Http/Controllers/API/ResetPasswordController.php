<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ResetPasswordRequest;
use App\Models\User;
use App\Services\ResetPasswordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __construct(public ResetPasswordService $resetPasswordService){}
    public function __invoke(ResetPasswordRequest $request): JsonResponse
    {
        $code = $request->validated('code');
        $isCodeExist = $this->resetPasswordService->isCodeExist($code);
        $isCodeExpired = $this->resetPasswordService->isCodeExpired($code);
        if ($isCodeExist && !$isCodeExpired) {
            User::firstWhere('email', $isCodeExist->email)->update([
                'password' => $request->validated('password')
            ]);
            return response()->json(['message' => 'Password Reset Successfully']);
        }
        return response()->json(['message' => 'Invalid Code or Code Expired..']);
    }
}
