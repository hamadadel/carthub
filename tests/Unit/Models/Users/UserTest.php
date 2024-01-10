<?php

namespace Tests\Unit\Models\Users;

use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{

    public function test_it_hashes_the_password_when_creating_a_user()
    {
        $user = User::factory()->create(['password' => 'secret']);
        $this->assertNotEquals($user->password, 'secret');
    }
}
