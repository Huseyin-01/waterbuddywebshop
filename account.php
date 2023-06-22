<?php

error_reporting(E_ERROR | E_PARSE);

session_start();
$page_title = 'WaterBuddy Webstore';
include ('header.php');

// mysqli_connect.php bevat de inloggegevens voor de database.

include ('Includes/Mysqli_connect_'.$_SERVER['SERVER_NAME'].'.php');

// Page header
echo '<h1>Your accounts details</h1>';

//
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// check connection bij geen connectie foutmelding geven
if (mysqli_connect_errno()) {
	printf("<p><b>Error: Connecting to the database failed</b><br/>\n%s</p>\n", mysqli_connect_error());
	exit();
}

// Geef aan of je wel of niet al ingelogd ben op basis van een sessie op customernr en geef de mogelijkeid om uit te loggen in combinatie met function logout
	if (empty($_SESSION['customernr'])) {
		echo "<li id='account'>you are not logged in | <a href=\"login.php\">login</a></li>\n";
	} else {
		echo "<li id='account'>Welcome <a href=\"account.php\">".$_SESSION['customername']."</a> | <a href=\"javascript:logOut()\">logout</a></li>\n";
	}
	echo("</ul>");
	if (!isset($active)) $active = 0;


// kijk of de klant is ingelogd en geef dan de data van de klant weer uit de de tabel customers
if (empty($_SESSION['customernr'])) {
	echo "<p>You aren't logged in</p>\n";
} else {
	$customernr = $_SESSION['customernr'];

	$sql = "SELECT `name`, `address`, `zipcode`, `city`, `emailaddress` FROM `customers` WHERE `customernr`='".$customernr."'";
	// Voer de query uit en sla het resultaat op 

	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>Error in file ".__FILE__." on line ".__LINE__);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
	echo "<table id='accounttable'>\n";
	echo "<tr><td id='links'>Name</td> <td id='rechts'>".$row["name"]."</td></tr>\n";
	echo "<tr><td id='links'>Address</td><td id='rechts'>".$row["address"]."</td></tr>\n";
	echo "<tr><td id='links'>Zipcode</td><td id='rechts'>".$row["zipcode"]."</td></tr>\n";
	echo "<tr><td id='links'>City</td><td id='rechts'>".$row["city"]."</td></tr>\n";
	echo "<tr><td id='links'>Emailaddress</td><td id='rechts'>".$row["emailaddress"]."</td></tr>\n";
	echo "<tr><td id='links'>Customernr</td><td id='rechts'>".$customernr."</td></tr>\n";
	echo "</table>\n";

}



// Sluit de connection
mysqli_close($conn);

// javascript functie om uit te kunnen loggen met popup of je zeker bent van uit loggen
?>
<script type="text/javascript">

function logOut() {
	var answer = confirm ('Are you sure you want to logout?')
	if (answer)
		window.location="logout.php";
}

</script>


