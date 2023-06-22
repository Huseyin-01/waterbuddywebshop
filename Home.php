<?php

require_once('Languages/Home/chosenlanguage.php');
// require_once('Languages/Home/connect.php');
include('DbConnection.php');
$page_title = "Home Waterbuddy";
include('header.php');
require('MessageHandler.php');
require('DateHandler.php');

// include('dbconnect.php');

// require('form_validator.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="CSS/Style_Home.CSS">

    <!-- <link rel= "stylesheet" href="Style_General.css"> -->
    <!-- Welkom bij mijn website. Ik hoop dat ik hiermee voldoende laat zien qua HTML, CSS en JS. 
        Ik ben in iedergeval trots op me website. Ik hoop jullie ook :D!  -->

</head>

<body>
    <div style="color: red; display: flex; flex-direction: column; align-items: center;">
        <?php
        $message = new MessageHandler("Welcome to Waterbuddy");
        $message->displayMessage();
        $dateHandler = new DateHandler();
        $dateHandler->displayDate();
        ?>
    </div>
    <!-- navigatiebalk -->
    <!-- <header>
        <a class="buddy">
            <div class="buddy">
                <img src="CSS/Images/General/Waterbuddy_Logo.png" alt="eigen ontwerp"
                title="in de tekst"
                width="50"
                height="50">
                
                <span>Waterbuddy</span>

            </a>
    
<nav>
<div id="webshop" class="webshop"> 
    <button</button>
    <a href="Home.php"class="Home"> <?php echo $language["Home"]; ?></a>
    <a href="webshop.php"class="Home"><?php echo $language["Webshop"]; ?></a>
    <a href="about.php"class="Home"><?php echo $language["About us"]; ?></a>
    <a href="contact.html"class="Home"><?php echo $language["Contact"]; ?></a>
    <?php echo $language["Search"]; ?>
    <a href="?language=nl" ><img class="nlvlag" src="CSS/Images/General/NL_Flag.jpg" ></a>
    <a href="?language=en"><img class= "envlag" src="CSS/Images/General/EN_Flag.png" alt="istockphoto"></a>
</div>
</div></nav>
</header>  -->

    <!-- De takken op de zijkant van de pagina-->
    <img class="Tak" src="CSS/Images/Tak1.png" alt="unsplash">
    <img class="Tak2" src="CSS/Images/Tak2.png" alt="unsplash">

    <!-- Het inschrijven voor de nieuwsbrief per email-->
    <div class="Planten">
        <h1><?php echo $language["Let us help you keep your plants fresh and alive"]; ?></h1>
        <img class="Plantje" src="CSS/Images/plantje.png" alt="unsplash">
    </div>
    <div class="Nieuw">
        <h2><?php echo $language["Subscribe to the newsletter to get the latest tips and tricks"]; ?></h2>
    </div>
    <div class="Email">
        <form method="post">
            <em><?php echo $language["Enter your email address"]; ?></em> <input id="Emailfield" type="text" size="30" maxlength="100" name="email">
            <input type="submit" class="Web" value="<?php echo $language["Notify me"]; ?>" />
        </form>
    </div>

    <?php
    if (isset($_POST['email']) && $_POST['email'] != '') {
        $dbConnection = new DbConnection();
        $dbConnection->connect();

        $email = $_POST['email'];

        $sql = "INSERT INTO nieuwsbrieven (email) VALUES (:email)";
        $stmt = $dbConnection->getConnection()->prepare($sql);

        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo "Email added successfully to the database.";
        } else {
            echo "Error adding email to the database.";
        }
    }


    // if (isset($_POST['email']) && $_POST['email'] != '') {
    //     // in deze tabel wordt het toegevoegd in de database
    //     $sql = "INSERT INTO nieuwsbrieven (email) VALUES (:email)";

    //     $stmt = $connection->prepare($sql);
    //     // stmt is het statement die het execute, deze toepassing bindt de waarden aan de parameters en de database voert de instructie uit
    //     $result = $stmt->execute([
    //         "email" => $_POST['email']
    //     ]);
    //     // als het resultaat niet goed is krijg je de die andere zet echo de tekst hieronder neer
    //     if (!$result) {
    //         die('There was an error running the query [' . $conn->error . ']');
    //     } else {
    //         echo $language["Thank you! We will contact you soon"];
    //     }
    // }

    // if (isset($_POST['email'])) {
    //     // hier ga ik de formulier valideren
    //     $validation = new formValidator($_POST);
    //     $errors = $validation->validateForm();

    //     if (empty($_POST['email'])) {
    //         $errors = $validation->validateForm();
    //     } else {
    //         $sql = "INSERT INTO `nieuwsbrieven` (`email`) VALUES " .
    //             "('" . $_POST['email'] . "');";
    //         if (mysqli_query($conn, $sql)) {
    //             echo $language["Thank you! We will contact you soon"];
    //         } else {
    //             echo "query error: " . mysqli_error($conn);
    //         }
    //     }
    // }
    ?>






    <!--<script>
        function myFunction() {
        var emailInput = document.getElementById("Emailfield").value;
		if(emailInput.indexOf('@') == -1)
		{
			alert('Emailadres incorrect');
			hasError = true;
		} else {
            alert("Thanks for registering");
        }
    }
    </script>
    </form></div> -->

    <!-- store apps-->
    <div class="App">
        <img class="Telefoon" src="CSS/Images/Telefoon.png" alt="freepik.com">
        <p><a href="https://www.apple.com/nl/app-store">
                <img class="Apple" src="CSS/Images/AppleStore.png"></a>
            <a href="https://play.google.com/store"><img class="Google" src="CSS/Images/GooglePlay.png"></a>
        </p>
        <img class="Tablet" src="CSS/Images/Tablet.png" alt="freepik.com">
    </div>

    <!--uitleg waarom WaterBuddy-->
    <br>
    <h3>
        <div class="Inhoud"><?php echo $language["Why Waterbuddy?"]; ?>
    </h3>
    </div>
    <center>
        <p>
            <?php echo $language["Most people love greenery in their homes, e.g., houseplants."]; ?>
            <?php echo $language["Nowadays, plants are relatively expensive."]; ?>

            <?php echo $language["An annoyance for many people is that they cannot (properly) maintain the plants after buying them, this is at the expense of quality."]; ?>

            <?php echo $language["After all, not everyone has green fingers."]; ?>
            <?php echo $language["We at Watterbuddy have found the perfect solution for this: The plant sensor Waterbuddy!"]; ?></p>
    </center>

    <h3>
        <div class="Inhoud2"><?php echo $language["How it works?"]; ?>
    </h3>
    </div>
    <center>
        <p><?php echo $language["The sensor is placed in the plant, where it measures when the plant needs additional water."]; ?>
            <?php echo $language["This measurement takes place via Bluetooth, with a specially developed app compatible for all operating systems."]; ?>
            <?php echo $language["Thus, you can download this app on your desired device and set it to your chosen plant."]; ?>
            <?php echo $language["The sensor reads the dryness of the soil in the pot."]; ?>
            <?php echo $language["If the soil becomes too dry, you get a notification on your connected device – it’s time to water your plant!"]; ?>
            <?php echo $language["If you have several plants, it is recommended to purchase several sensors."]; ?>
            <?php echo $language["Also, the application is designed to know immediately what kind of plant it is."]; ?>
            <?php echo $language["The notifications given by the application show up on your device."]; ?>
            <?php echo $language["Hence, you are reminded not to forget the plant!"]; ?>
            <?php echo $language["In addition, the application provides fun facts about the plant: e.g., properties of the plant."]; ?>
    </center>
    </p>

    <h2>
        <center><?php echo $language["Order your Waterbuddy Now"]; ?>
    </h2>
    </center>
    <div>
        <!-- Ga naar de webshop-->
        <div class="winkelwagen">
            <img src="CSS/Images/Pijl.png" alt="freepik.com">
            <a href="webshop.php" class="button"><?php echo $language["Go to the webshop"]; ?></a>
            <img src="CSS/Images/WinkelWagen.png" alt="freepik.com">
        </div>

        <!-- achtergrond -->
        <img class="bladdruppel" src="CSS/Images/Bladdruppel.png" alt="eigen ontwerp" width="800" height="800">
        <style>
            img.bladdruppel {
                position: absolute;
                left: 300px;
                top: 100px;
                z-index: -1;
            }
        </style>
        <div></div>

</body>

<footer>

    <!-- Onderstaand de twee download buttons onderaan de pagina -->

    <div class="download">
        <button type="button" class="buttonFooter navbuttonFooter"><i class="fab fa-apple"></i> Download</button>
        <button type="button" class="buttonFooter navbuttonFooter"><i class="fab fa-google-play"></i> Download</button>

    </div>

    <p class="copyright">© Copyright 2021 WaterBuddy</p>

</footer>

</html>