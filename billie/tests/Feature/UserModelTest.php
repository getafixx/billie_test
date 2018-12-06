<?php

namespace Tests\Feature;

use App\Address;
use App\User;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    public function testUserAddress()
    {
        $this->setUp();

        $this->assertDatabaseMissing('users', [
            'email' => 'sally@example.com'
        ]);

        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);

    }

}
