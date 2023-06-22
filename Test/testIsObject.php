
<?php

use PHPUNIT\FRAMEWORK\TestCase;

require('user.php'); // de User klasse word hier opgenomen om de methoden te testen

class TestIsObject extends TestCase
{
    public function testIsObject() {

        $user = new User();

        $this->assertIsObject($user);
    }
}

