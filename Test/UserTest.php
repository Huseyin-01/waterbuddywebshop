<?php
use PHPUnit\Framework\TestCase;

require('user.php');

class UserTest extends TestCase
{
    public function testGetFullName()
    {
        $user = new User();

        // Verifieer dat de volledige naam correct wordt geretourneerd
        $fullname = $user->getFullName('John', 'Doe');
        $this->assertEquals('John Doe', $fullname);
    }

    public function testSum()
    {
        $user = new User();

        // Verifieer dat de som van twee getallen correct wordt berekend
        $result = $user->sum(3.14, 2.86);
        $this->assertEquals(6.00, $result);
    }

    public function testGetEmailVariables()
    {
        $user = new User();

        // Verifieer dat de juiste variabelen worden geretourneerd
        $variables = $user->getEmailVariables();
        $this->assertArrayHasKey('fullname', $variables);
        $this->assertArrayHasKey('email', $variables);
        $this->assertEquals('Hans Boer', $variables['fullname']);
        $this->assertEquals('HANS_BOER@AVANS.NL', $variables['email']);
    }
}
?>
