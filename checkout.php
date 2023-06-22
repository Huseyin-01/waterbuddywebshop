<?php
error_reporting(E_ERROR | E_PARSE);
// checkout.php
$page_title = 'WaterBuddy Webstore';
include ('header.php');
session_start();
// mysqli_connect.php bevat de inloggegevens voor de database.
include ('includes/mysqli_connect_'.$_SERVER['SERVER_NAME'].'.php');


if (empty($_SESSION['customernr'])) {
    echo "<p>You are not logged in yet please login to continue the purchases.</p>\n";
} else {

	// afsluiten bestelling en bestelregel opslaan in database

	//connectie maken met database webwinkel
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	 
	// check connection
	if (mysqli_connect_errno()) {
		printf("<p><b>Error: connecting to the database failed.</b><br/>\n%s</p>\n", mysqli_connect_error());
		
		exit();
	}

	// Stap 1, zet de order in de bestelling tabel
	$sql = "INSERT INTO orders (`customernr`) VALUES ('".$_SESSION['customernr']."');"; 
	$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);

	$ordernumber = mysqli_insert_id($conn); // insert_id geeft de id terug van het autoincrement veld - het bestelnr dus.

	// Stap 2, winkelwagen splitsen en in de database zetten
	$cart = explode("|",$_SESSION['cart']);

	foreach($cart as $products) {
		// Splits het product in stukjes: $product[x] --> x == 0 -> product id, x == 1 -> hoeveelheid
		$product = explode(",",$products);

		// Hier willen we productprijs toevoegen aan de productregel. We kunnen dan de totaalprijs berekenen.
		$sql = "INSERT INTO orderline (ordernumber, productnumber, amount_ordered) VALUES
		(".$ordernumber.", ".$product[0].", ".$product[1].")";
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
	}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you for your order!</title>

    <!-- Favicon hiermee word het icoontje in het browser tabje gevuld -->
    <link rel="icon" href="Images/favicon-16x16.png">

    <!-- SCC stylesheet  hiermee word mijn style sheet ingeladen-->
    <link rel="stylesheet" href="CSS/Style_General.CSS">
    <link rel="stylesheet" href="CSS/Style_Purchases.CSS">
    

    <!-- fontawesome script is benodigd om bepaalde icoontjes in te laden -->
    <script src="https://kit.fontawesome.com/6c7c0095fb.js" crossorigin="anonymous"></script>


</head>

<body>

    <!-- Onderstaande code maakt in html de navigatie bar -->



    <main>

            <div class="purchases">
                <p>Thank you for the purchases of the WaterBuddy your plants will never be happier!</p>
                <p>Your WaterBuddy will be safely shipped in a recyclable package to not only make your plants happy but also our planet. </p>
            </div>

            <div><img src="CSS/Images/thankyou.jpg" alt="thank you"></div>


    </main>


    <footer>

<!-- Onderstaand de twee download buttons onderaan de pagina -->

<div class="download">
  <button type="button" class="buttonFooter navbuttonFooter"><i class="fab fa-apple"></i> Download</button>
  <button type="button" class="buttonFooter navbuttonFooter"><i class="fab fa-google-play"></i> Download</button>

</div>

<p class="copyright">© Copyright 2021 WaterBuddy</p>

</footer>


</body>

</html>


<?php
	
	

	// Sluit de sessie
	if(isset($_SESSION['cart']))
		unset($_SESSION['cart']);

	// Sluit de connection
	mysqli_close($conn);
}	


?> 
