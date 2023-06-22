<?php
//index.php
//startscherm van de webwinkel
session_start();
// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

$page_title = 'WaterBuddy Webshop';
include ('header.php');
require_once('Languages/Home/chosenlanguage.php');

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server
include ('includes/mysqli_connect_'.$_SERVER['SERVER_NAME'].'.php');

// Page header:
echo '<h1>Login</h1>';

// Toon eventuele foutmeldingen.
if ( $_SERVER['REQUEST_METHOD'] == 'POST') // && isset($_POST['email']) && isset($_POST['password']))
{
	// We gaan de errors in een array bijhouden
	// We kunnen dan alle foutmeldingen in één keer afdrukken.
	$aErrors = array();

	//  Kijk of een email adres is ingevoerd
	if ( empty($_POST['emailaddress'])) {
		$aErrors['emailaddress'] = 'No valid emailaddress.';
	}

	// Wanneer er geen foutieve invoer is gaan we naar de database.
	if ( count($aErrors) == 0 ) 
	{
		// Gebruiker uit database lezen.
		$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
 
		// check connection
		if (mysqli_connect_errno()) {
			printf("<p><b>Error: connecting to the database failed.</b><br/>\n%s</p>\n", 
					mysqli_connect_error());
			exit();
		}

		$sql = "SELECT `customernr`, `name` FROM `customers` WHERE `emailaddress`='".$_POST['emailaddress']."';";
		// Voer de query uit 
		$result = mysqli_query($conn, $sql) or die (mysqli_error($conn)."<br>in file ".__FILE__." on line ".__LINE__);
		
		if(mysqli_num_rows($result) == 0) {
			$aErrors['emailaddress'] = 'Emailaddress was not found.';
			unset($_POST['emailaddress']);
		} else {
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

			// Bij een ingelogde gebruiker bewaren we de naam en het klantnr in de sessie.
			// Hiermee kunnen we de klantnaam op het scherm tonen, en de winkelwagen aan 
			// het juiste klantnr koppelen, zodat de bestelling later afgerond kan worden.
			$_SESSION['customernr'] = $row["customernr"];
			$_SESSION['customername'] = $row["name"];
			// Sluit de connection
			mysqli_close($conn);

			header('Location: account.php');
			exit();
		}
	}
}
?>
	<p><?php echo $language["New user? Create an new account"]; ?> <a href="registreer.php"><?php echo $language["register here"]; ?></a>.</p>
   <form class="login" action="login.php" method="post" class="formulier">
      <?php
      if ( isset($aErrors) and count($aErrors) > 0 ) {
			print '<ul class="errorlist">';
			foreach ( $aErrors as $error ) {
				print '<li>' . $error . '</li>';
			}
			print '</ul>';
      }
      ?>
			 <fieldset>
        <legend><?php echo $language["Login"]; ?></legend>
        <ol>
          <li class="loginlist">
            <label for="emailaddress"><?php echo $language["E-mail"]; ?></label>
            <input id="emailaddress" name="emailaddress" value="<?php echo isset($_POST['emailaddress']) ? htmlspecialchars($_POST['emailaddress']) : '' ?>" />
          </li>
        </ol>
        <input type="submit" value=<?php echo $language["Login"]; ?> class="button"/>
      </fieldset>
    </form>
		
	
	
	<p class="loginemployee"> <a href="http://localhost/phpmyadmin/index.php">Employee login</a>.</p>

