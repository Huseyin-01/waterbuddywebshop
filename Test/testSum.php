<?php

use PHPUNIT\FRAMEWORK\TestCase;

require('user.php'); // de User klasse word hier opgenomen om de methoden te testen

class TestSum extends TestCase
{
    public function testSum()
    {

        $user = new User();

        $result = $user->sum(10, 20);

        $this->assertEquals(30, $result);
    }
}
