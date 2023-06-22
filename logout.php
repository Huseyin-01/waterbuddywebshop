<?php
// logout.php
session_start();

if (empty($_SESSION['customernr']))
	echo "<p>You are now logged out.</p>";
// else 
// 	session_unset($_SESSION['customernr']);

if (empty($_SESSION['customername']))
	echo "<p>You are now logged out</p>";
// else 
// 	session_unset($_SESSION['customername']);

// Direct door naar de homepagina.
header("Location: Home.php"); ;

?> 
