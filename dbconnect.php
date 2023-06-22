<?php
// variabelen om verbinding te maken met de database
$server = "localhost";
$username = "root";
$password = "";
$dbname = "waterbuddy_store";

// functie maakt verbinding met de database
$conn = mysqli_connect($server, $username, $password, $dbname);
