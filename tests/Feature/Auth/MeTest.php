<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MeTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_fails_if_user_is_not_authenticated(): void
    {
        $this->json('GET', 'api/auth/me')
            ->assertStatus(401);
    }

    public function test_it_returns_user_details_if_is_authenticated(): void
    {
    }
}
