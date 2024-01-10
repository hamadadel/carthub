<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\PrivateUserResource;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $token = JWTAuth::attempt($request->only('email', 'password'));
        if (!$token)
            return response()->json([
                'error' =>  'Wrong Credentials'
            ], 422);


        return (new PrivateUserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token,
                ]
            ]);
    }
}
