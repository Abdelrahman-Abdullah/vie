<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserRegisterRequest;
use App\Http\Resources\API\UserResource;
use App\Models\User;
use App\Traits\Responses;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    use Responses; // Custom Trait for API Responses
    public function __invoke(UserRegisterRequest $request): JsonResponse
    {
        $user = User::create($request->validated());
        return self::success(
            'User created successfully, Please login to continue.',
            new UserResource($user), // data
            201,
        );
    }
}
