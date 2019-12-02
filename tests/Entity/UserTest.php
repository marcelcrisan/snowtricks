<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUsernameSetterGetter()
    {
        $user = new User();

        $user->setUsername('Billy');

        $this->assertEquals($user->getUsername(), 'Billy');
    }

    public function testEmailSetterGetter()
    {
        $user = new User();

        $user->setEmail('billy@symfony.com');

        $this->assertEquals($user->getEmail(), 'billy@symfony.com');
    }
}