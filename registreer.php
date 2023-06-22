<?php
//index.php
//startscherm van de webwinkel

$page_title = 'WaterBuddy Webstore';
include ('header.php');
require_once('Languages/Home/chosenlanguage.php');

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server
include ('includes/mysqli_connect_'.$_SERVER['SERVER_NAME'].'.php');

// Page header:
?>
<h1><?php echo $language["Create an account"]; ?></h1>
<?php 
//  echo '<h1>Create an account</h1>';


// 
// Stap 1: maak verbinding met MySQL.
// Zorg ervoor dat MySQL (via XAMPP) gestart is.
//
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
// check connection
if (mysqli_connect_errno()) {
	printf("<p><b>Error: connecting to the database failed.</b><br/>\n%s</p>\n", mysqli_connect_error());
	exit();
}

// Deze pagina toont zelf de foutmeldingen wanneer een van de velden
// in het formulier niet juist is ingevuld. De volgende code
// toont deze meldingen.
if ( $_SERVER['REQUEST_METHOD'] == 'POST' &&
	isset($_POST['name'], $_POST['emailaddress'], $_POST['password'], $_POST['address'], $_POST['city'], $_POST['zipcode']) )
{
	// We gaan de errors in een array bijhouden
	// We kunnen dan alle foutmeldingen in een keer afdrukken.
	$aErrors = array();

	//  Een naam bevat letters en spaties (minimaal 3)
	if ( !isset($_POST['name']) or !preg_match( '~^[\w ]{3,}$~', $_POST['name'] ) ) {
		$aErrors['name'] = 'Invalid name';
	}

	//  Een email-adres is wat ingewikkelder
	if ( !isset($_POST['emailaddress']) or !preg_match( '~^[a-z0-9][a-z0-9_.\-]*@([a-z0-9]+\.)*[a-z0-9][a-z0-9\-]+\.([a-z]{2,6})$~i', $_POST['emailaddress'] ) ) {
		$aErrors['emailaddress'] = 'Emailadres is invalid';
	}

	//  Een adres heeft letters, cijfers, spaties (minimaal 5)
	if ( !isset($_POST['address']) or !preg_match( '~^[\w\d ]{5,}$~', $_POST['address'] ) ) {
		$aErrors['address'] = 'Address is invalid.';
	}

	//  Een plaatsnaam heeft letters, spaties en misschien een apostrof
	if ( !isset($_POST['city']) or !preg_match( '~^[\w\d\' ]*$~', $_POST['city'] ) ) {
		$aErrors['city'] = 'Invalid city';
	}

	//  Een postcode heeft vier cijfers, eventueel een spatie, en twee cijfers
	if ( !isset($_POST['zipcode']) or !preg_match( '~^\d{4} ?[a-zA-Z]{2}$~', $_POST['zipcode'] ) ) {
		$aErrors['zipcode'] = 'Invalid zipcode';
	}
	
	// wachtwoord (minimaal 3)
	// if ( !isset($_POST['password']) or !preg_match( '~^[\w ]{3,}$~', $_POST['password'] ) ) {
	// 	$aErrors['password'] = 'Geen password ingevuld.';
	// }

	if ( count($aErrors) == 0 ) 
	{
		// Gebruiker in database registreren.
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
		}

		$sql = "INSERT INTO `customers` (`name`, `address`, `zipcode`, `city`, `emailaddress`) VALUES ".
				"('".$_POST['name']."', '".$_POST['address']."', '".$_POST['zipcode']."', '".$_POST['city']."', '".$_POST['emailaddress']."');";

		// Voer de query uit en vang fouten op 
		if( !mysqli_query($conn, $sql) ) {
			$aErrors['emailaddress'] = 'Registration valid email already exist';
		} else {
			// Met myslqi_insert_id krijg je de id van het autoincrement veld terug - het klantnr.
			$klantnr = mysqli_insert_id($conn); 
			
			$_SESSION['customernr'] = $customernr;
			$_SESSION['name'] = $_POST["name"];
		
			// Sluit de connection
			mysqli_close($conn);

			header('Location: login.php');
			exit();
		}
	}
}
?>
<form action="registreer.php" method="post" class="formulier">
  <?php
  if ( isset($aErrors) and count($aErrors) > 0 ) {
		print '<ul class="errorlist">';
		foreach ( $aErrors as $error ) {
			print '<li>' . $error . '</li>';
		}
		print '</ul>';
  }
  ?>
  <p><?php echo $language["Fill out below form. Fields with"]; ?> <em>*</em> <?php echo $language["are mandotory."]; ?></p>

  <fieldset>
	<legend><?php echo $language["Your details"]; ?></legend>
	<ol>
	  <?php echo isset($aErrors['name']) ? '<li class="error">' : '<li>' ?>
		<label for="name"><?php echo $language["Name"]; ?><em>*</em></label>
		<input id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['emailaddress']) ? '<li class="error">' : '<li>' ?>
		<label for="emailaddress"><?php echo $language["Emailaddress"]; ?><em>*</em></label>
		<input id="emailaddress" name="emailaddress" value="<?php echo isset($_POST['emailaddress']) ? htmlspecialchars($_POST['emailaddress']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['address']) ? '<li class="error">' : '<li>' ?>
		<label for="address"><?php echo $language["Address"]; ?><em>*</em></label>
		<input id="address" name="address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['zipcode']) ? '<li class="error">' : '<li>' ?>
		<label for="zipcode"><?php echo $language["Zipcode"]; ?><em>*</em></label>
		<input id="zipcode" name="zipcode" value="<?php echo isset($_POST['zipcode']) ? htmlspecialchars($_POST['zipcode']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['city']) ? '<li class="error">' : '<li>' ?>
		<label for="city"><?php echo $language["City"]; ?></label>
		<input id="city" name="city" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '' ?>" />
	  </li>
	  <?php echo isset($aErrors['password']) ? '<li class="error">' : '<li>' ?>
		<label for="password"><?php echo $language["Password"]; ?><em>*</em></label>
		<input id="password" name="password" type="password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>" />
	  </li>
	</ol>
	<input type="submit" value=<?php echo $language["Send"]; ?> class="button"/>
  </fieldset>
</form>
<?php	

?>