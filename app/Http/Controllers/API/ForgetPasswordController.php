<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserForgetPasswordRequest;
use App\Models\ResetPassword;
use App\Notifications\ResetPasswordCodeNotification;
use App\Services\ResetPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Throwable;

class ForgetPasswordController extends Controller
{
    public function __construct(public ResetPasswordService $resetPasswordService)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(UserForgetPasswordRequest $request)
    {
        $validatedEmail = $request->validated('email');
        try {
            //Generate Reset Code
            $resetCode = $this->resetPasswordService->getResetCode();
            //Save Reset Code
            $this->resetPasswordService->saveResetCode($validatedEmail, $resetCode);
            //Send Email
            Notification::route('mail', $validatedEmail)
                ->notify(new ResetPasswordCodeNotification($resetCode));
            // Return Response
            return response()->json(['message' => 'Reset Code Sent Successfully']);
        } catch (Throwable $th) {
            return response()->json(['message' => 'Something went wrong']);
        }

    }
}
