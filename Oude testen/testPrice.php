
<?php

use PHPUNIT\FRAMEWORK\TestCase;

require('user.php'); // de User klasse word hier opgenomen om de methoden te testen

class TestPrice extends TestCase
{
    public function testSetPrice(float $price)
    {
        $user = new User();

        $user->setPrice(15);

        $this->assertIsA($price, $user);
    }
}

