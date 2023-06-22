<?php

// deze klasse valideert de formulier binnen de contact pagina
// php staat voor: hypertext preprocessor PHP voert code uit op de server. JS voert code uit op de client.

class formValidator
{
    private $data; // voor post[''] data 
    private $errors = []; // zodra er errors zijn worden ze opgenomen binnen deze error array
    private static $fields = ['firstname', 'lastname', 'email', 'subject']; // static zodat er geen object van gemaakt hoeft te worden om te checken voor velden
    // object maken: new formValidator::$fields om te checken of deze velden gebruikersinvoer hebben
    // waarom static: als je een variabelen wilt die altijd dezelfde waarde heeft voor elke instantie/object van de klasse.

    // invoerveld data (post) wordt opgenomen binnen de constructor
    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    // methoden om invoervelden te valideren
    public function validateForm()
    {
        // bij de construct geven we de post data, dan gaan we hieronder kijken of de velden terugkomen zo niet, geven we een error.
        // self::$fields benaderen fields zonder object te maken. self refereert naar de klasse zelf
        // het is belangrijk om eerst te kijken of de velden wel bestaan binnen de Post variabelen. zo niet, heeft het geen zin om ze te valideren.
        foreach (self::$fields as $field) { // loop door velden om te kijken of: ... hier self:: opgenomen omdat de fields array static is.
            if (!array_key_exists($field, $this->data)) { // eerst kijken bestaat de field key, en dan in welke array willen we dit checken. dat wordt de data array want daar zit de post array in.
                trigger_error("$field is not present in data"); // alleen een error_trigger als veld niet voorkomt in post data..
                return;
            }
        }
        $this->validateFirstname();
        $this->validateLastname();
        $this->validateEmail();
        $this->validateSubject();
        return $this->errors;
    }

    public function validateFirstname()
    {
        $value = trim($this->data['firstname']);

        if (empty($value)) {
            $this->addError('firstname', 'Firstname is required');
        } elseif (empty($value) || !preg_match('~^[a-z]{3,}$~', $value)) {
            $this->addError('firstname', 'Firstname cannot be numeric!');
        } elseif (empty($value) || !preg_match('~^[a-z]{3,10}$~', $value)) {
            $this->addError('firstname', 'Firstname must be 3 - 10 chars!');
        }
    }
    // je begint en eindigt met een slash bij REGEXP maar je kunt volgens mij ook beginnen en eindigen met en tilde!!!
    public function validateLastname()
    {
        $value = trim($this->data['lastname']);

        if (empty($value)) {
            $this->addError('lastname', 'Lastname is required');
        } elseif (empty($value) || !preg_match('~^[a-z]{3,}$~', $value)) {
            $this->addError('lastname', 'Lastname cannot be numeric!');
        } elseif (empty($value) || !preg_match('~^[a-z]{3,10}$~', $value)) {
            $this->addError('lastname', 'Lastname must be 3 - 10 chars!');
        }
    }

    public function validateEmail()
    {

        $value = trim($this->data['email']);

        if (empty($value)) {
            $this->addError('email', 'Email is required');
        }
        // } else {
        //     if (filter_var($value, FILTER_VALIDATE_EMAIL));
        //     $this->addError('email', 'Email must contain @ sign and 5 - 50 chars!');
        // }
    }

    public function validateSubject()
    {
        $value = trim($this->data['subject']);

        if (empty($value)) {
            $this->addError('subject', 'Message is required');
        }
    }

    // zodra alle checks zijn gedaan word een error array uitgevoerd
    public function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }
}
