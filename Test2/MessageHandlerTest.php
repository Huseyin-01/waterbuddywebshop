<?php

require('MessageHandler.php');

use PHPUnit\Framework\TestCase;

class MessageHandlerTest extends TestCase
{
    public function testDisplayCurrentDayOfWeek()
    {
        $currentDayOfWeek = date('l');
        $expectedOutput = '<p>Today is ' . $currentDayOfWeek . '</p>';

        $messageHandler = new MessageHandler($expectedOutput);

        // Verifieer dat de methode displayMessage het verwachte resultaat bevat
        ob_start();
        $messageHandler->displayMessage();
        $output = ob_get_clean();

        $this->assertStringContainsString($expectedOutput, $output);
    }
}
