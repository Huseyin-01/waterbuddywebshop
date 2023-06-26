
<?php

use PHPUNIT\FRAMEWORK\TestCase;

require('user.php'); // de User klasse word hier opgenomen om de methoden te testen

class TestEmail extends TestCase
{
    public function testEmailToUppercase()
    {
        $user = new User();

        $user->setEmail('hans@avans.nl');

        $this->assertNull($email);
    }
}
