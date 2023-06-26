<?php

require('IMessage.php');

class MessageHandler implements Message
{
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function displayMessage()
    {
        echo '<p>' . $this->message . '</p>';
    }
    
}
