<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{

    public function test_it_requires_a_name()
    {
        $this->json('POST', '/api/auth/register')
            ->assertJsonValidationErrors(['name']);
    }
    public function test_it_requires_a_name__with_min_4_length()
    {
        $this->json('POST', '/api/auth/register', ['name' => 'abc'])
            ->assertJsonValidationErrors(['name']);
    }
    public function test_it_requires_a_name__with_max_70_length()
    {
        $this->json('POST', '/api/auth/register', ['name' => 'abcdefghijklmnopqheiabcdefghijklmnopqheiabcdefghijklmnopqheiabcdefghijklmnopqhei'])
            ->assertJsonValidationErrors(['name']);
    }

    public function test_it_requires_an_email()
    {
        $this->json('POST', '/api/auth/register')
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_a_valid_email()
    {
        $this->json('POST', '/api/auth/register', ['email' => 'valid#email'])
            ->assertJsonValidationErrors(['email']);
    }

    public function test_it_requires_a_unique_email()
    {
        $user = User::factory()->create();

        $this->json('POST', '/api/auth/register', ['email' => $user->email])
            ->assertJsonValidationErrors(['email']);
    }


    public function test_it_requires_a_password()
    {
        $this->json('POST', '/api/auth/register')
            ->assertJsonValidationErrors(['password']);
    }


    public function test_it_registers_a_user()
    {
        $this->json('POST', '/api/auth/register', [
            'name' => $name = 'Alex',
            'email' => $email = 'alex@codecourse.com',
            'password' => 'secret'
        ]);
        $this->assertDatabaseHas('users', ['name' => $name, 'email' => $email]);
        // $user = User::factory()->create();
        // $this->assertInstanceOf(User::class, $user);
    }

    public function test_it_returns_a_user_on_registration()
    {
        $this->json(
            'POST',
            '/api/auth/register',
            [
                'name' => $name = 'Alex',
                'email' => $email = 'alex@codecourse.com',
                'password' => 'secret'
            ]
        )
            ->assertJsonFragment([
                'name' => $name,
                'email' => $email,
            ]);
    }
}
