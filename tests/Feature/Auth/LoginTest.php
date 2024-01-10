<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_requires_an_email()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonValidationErrors(['email']);
    }
    public function test_it_requires_a_valid_email()
    {
        $this->json('POST', 'api/auth/login', ['email' => 'invalid@'])
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_a_password()
    {
        $this->json('POST', 'api/auth/login')
            ->assertJsonValidationErrors(['password']);
    }
    public function test_it_requires_a_password_with_min_6_length()
    {
        $this->json('POST', 'api/auth/login', ['password' => 12345])
            ->assertJsonValidationErrors(['password']);
    }

    public function test_it_returns_a_validation_errors_if_credentials_do_not_match()
    {

        $this->json(
            'POST',
            '/api/auth/login',
            [
                'email' => 'hamad@gmail.com',
                'password' => 'nope12',

            ]
        )->assertJsonValidationErrors(['message']);
    }


    public function test_it_returns_a_token_if_credentials_do_match()
    {
        $user = User::factory()->create(['password' => 'secret']);
        $this->json(
            'POST',
            '/api/auth/login',
            [
                'email' => $user->email,
                'password' => 'secret'

            ]
        )->assertJsonStructure(['meta' => ['token']]);
    }
    public function test_it_returns_a_user_if_credentials_do_match()
    {
        $user = User::factory()->create(['password' => 'secret']);
        $this->json(
            'POST',
            '/api/auth/login',
            [
                'email' => $user->email,
                'password' => 'secret'

            ]
        )->assertJsonStructure(['data' => ['id', 'name', 'email']]);
    }
}
