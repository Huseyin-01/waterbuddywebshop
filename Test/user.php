<?php


class User
{

    private $firstname;
    private $lastname;
    private $email;
    private $number1;
    private $number2;
    private $price;
    private $varX;
    private $varY;


    public function setFirstname($firstname): void
    {

        if (strlen($firstname) < 8) {
            throw new \InvalidArgumentException('The firstname must be at least 8 characters');
        }
        $this->firstname = $firstname;
    }

    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setPrice(float $price): void
    {

        $this->price = $price;
    }

    public function getFullName(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        // er is hier een spatie en daarom werkt het niet.
        // maar met een trim functie geeft het geen error.
        return trim("$this->firstname $this->lastname");
    }

    public function Sum(float $number1, float $number2)
    {

        $this->number1 = $number1;
        $this->number2 = $number2;

        return $number1 + $number2;
    }

    public function setEmail($email)
    {
        if (strlen($email) > 5) {
            $result = strtoupper($email);
        }
        $this->email = $email;
        return $result;
    }

    public function getEmailVariables()
    {

        return [
            'fullname' => $this->getFullName('Hans', 'Boer'),
            'email' => $this->setEmail('hans_boer@avans.nl')
        ];
    }
}
