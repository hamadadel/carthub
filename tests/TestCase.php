<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tymon\JWTAuth\Contracts\JWTSubject;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    // public function jsonAs(JWTSubject $user, $method, $endpoint, $data = [], $headers = [])
    // {
    //     // $token = auth()->user()->currentAccessToken();
    //     dd(auth()->user());
    //     dd($user->currentAccessToken());
    // }
}
