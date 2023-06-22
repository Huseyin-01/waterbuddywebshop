<?php

use PHPUNIT\FRAMEWORK\TestCase;

require('user.php'); // de User klasse word hier opgenomen om de methoden te testen

class TestFullName extends TestCase
{
    public function testGetFullName()
    {
        $user = new User();

        $this->assertEquals('Jan Smith', $user->getFullName('Jan', 'Smith'));
    }
}
