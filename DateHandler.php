<?php

require('IDisplay.php');

class DateHandler implements DisplayDate
{
    private $date;

    public function __construct()
    {
        $this->date = date('Y-m-d');
    }

    public function displayDate()
    {
        echo "Today is: {$this->date}";
    }
}
