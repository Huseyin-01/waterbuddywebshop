<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'waterbuddy_store');
define('DB_USER', 'root');
define('DB_PASS', '');

function connectDatabase()
{
        $conn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        try {
                return new PDO($conn, DB_USER, DB_PASS);
        } catch (PDOException $e) {
                return NULL;
        }
}

$connection = connectDatabase();

if (!$connection)
        die('Verbinding met de database is mislukt.');
