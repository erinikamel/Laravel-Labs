<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testUser()
    {
        $user = new User;
        $this->assertEquals('Erini', $user->name());
        $this->assertEquals('Samy', $user->name('Samy'));
        $this->assertEquals('erini@gmail.com', $user->email());
        $this->assertEquals('Samy@gmail.com', $user->name('Samy@gmail.com'));
    }
}
