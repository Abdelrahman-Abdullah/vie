<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UserLoginRequest;
use App\Http\Resources\API\UserResource;
use App\Traits\Responses;
use Illuminate\Http\Request;

class UserAuthSessions extends Controller
{
    use Responses;
    public function login(UserLoginRequest $request){
        if (!auth()->attempt($request->only('email', 'password'))){
            return  self::error('Invalid Credentials', 401);
        }
        $user = auth()->user();
        $token = $user->createToken("{$user->name}-token")->plainTextToken;
        return self::success('User Logged In', [
            'token' => $token,
            'user' => new UserResource($user),
        ]);
    }
}
