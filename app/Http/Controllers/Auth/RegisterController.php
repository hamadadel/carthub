<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\PrivateUserResource;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        dd($request);
        $user = User::create($request->only('email', 'name', 'password'));
        return new PrivateUserResource($user);
    }
}
