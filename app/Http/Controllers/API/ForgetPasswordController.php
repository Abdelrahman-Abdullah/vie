<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserResetPasswordRequest;
use App\Models\ResetPassword;
use App\Notifications\ResetPasswordCodeNotification;
use App\Services\ResetPasswordService;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

class ForgetPasswordController extends Controller
{
    public function __construct(Public ResetPasswordService $resetPasswordService){}
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserResetPasswordRequest $request)
    {
        // Generate Reset Code
        // Send Email
        // Return Response
    }
}
