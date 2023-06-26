<?php

use PHPUNIT\FRAMEWORK\TestCase;

require('user.php'); // de User klasse word hier opgenomen om de methoden te testen

class TestUser extends TestCase
{
    public function testSetFirstname(string $firstname)
    {
        $user = new User();

        // we verwachten een exception. :: operator geeft toegang tot de functie in de andere klasse.
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The firstname must be at least 8 characters');

        $user->setFirstname('H@ns');
    }
}
