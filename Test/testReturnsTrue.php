<?php

use PHPUNIT\FRAMEWORK\TestCase;

require('user.php'); // de User klasse word hier opgenomen om de methoden te testen

class TestReturnsTrue extends TestCase
{
    public function testReturnsTrue()
    {

        $result = false;

        if (1 === 1) {
            $result = true;
        }

        $this->assertTrue($result);
    }
}
