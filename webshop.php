<?php
//
// index.php
// Dit is het startscherm van de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'WaterBuddy Webshop';
$active = 1;    // Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include('header.php');
require('newwebshop.php');
require_once('Languages/Home/chosenlanguage.php');

echo '<h1>Welcome to the WaterBuddy webshop!';

// Print aangepast welkomstbericht wanneer de gebruiker bekend is.
if (isset($_SESSION['customername'])) {
	echo " " . $_SESSION['customername'] . "</h1>";
} else {
	echo "</h1>\n";
}

$webshop = new Webshop();
$webshop->displayProducts();

include('includes/webshop1.php');
