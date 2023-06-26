<?php

use PHPUNIT\FRAMEWORK\TestCase;

require('user.php'); // de User klasse word hier opgenomen om de methoden te testen

class TestHasKey extends TestCase
{
    public function testHasKey()
    {
        $userArray = [
            'name' => 'Hans',
            'age' => '20'
        ];

        $this->assertArrayHasKey('age', $userArray);
    }
}
