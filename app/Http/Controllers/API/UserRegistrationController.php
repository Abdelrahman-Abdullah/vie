<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserRegisterRequest;
use App\Http\Resources\API\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserRegistrationController extends Controller
{
    public function __invoke(UserRegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = User::create($request->validated());
        return response()->json([
            'message' => 'User created successfully, Please login to continue.',
            'statusCode' => 201,
            'data' => new UserResource($user),
        ], 201);
    }
}
