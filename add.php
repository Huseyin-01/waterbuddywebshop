<?php
session_start();

// Het product wat we toevoegen moeten we eerst controleren
if(is_numeric($_POST['productnumber'])) {
    $productnumber = $_POST['productnumber'];
}
else {
    echo("Productnumber is not correct");
    echo "<p><a href=\"javascript:history.back()\">Page back</a></p>\n";
    exit();
}

//Controleren of invoer numerieke waarde is bij het aantal producten
if(is_numeric($_POST['quantity'])) {
    $quantity = $_POST['quantity'];
}
else {
    echo("Quanity not correct");
    echo "<p><a href=\"javascript:history.back()\">Page back<</a></p>\n";
    exit();
}

// als aantal 0 ingegeven word error geven want je kan niet 0 stuks bestellen
if ($quantity == 0) {
    echo "<p>Quantity 0 can't be ordered.</p>\n";
    echo "<p><a href=\"javascript:history.back()\">Page back<</a></p>\n";

    exit();
}

// Controleren of er al inhoud is op de winkelwagen
if (empty($_SESSION['cart'])){
    // Nee dus, een nieuwe maken
    $_SESSION['cart'] = $productnumber.",".$quantity; // Het productnummer,hoeveelheid staat dus in een sessie
}
else {
    // Winkelwagen opsplitsen
    $cart2 = explode("|",$_SESSION['cart']);

    // Winkelwagen inhoud tellen
    $count = count($cart2);

    // En controleren of het product al in de winkelwagen zit
    $add = TRUE; 
    
    foreach($cart2 as $value)
    {
        $product = explode(",",$value);
        if ($product[0] == $productnumber) {
            // Product al in de winkelwagen
            $product[1] = $product[1] + $quantity; // Nieuwe hoeveelheid is oude + nieuwe
            $add = FALSE; // Dus niet toevoegen
        }

        // En weer in de sessie zetten
        $i++;
        if ($i == 1) {
            $_SESSION['cart'] = $product[0].",".$product[1];
        }
        else {
            $_SESSION['cart'] = $_SESSION['cart']."|".$product[0].",".$product[1];
        }
    }

    if ($add) { // Als we dus wel moeten toevoegen
        $_SESSION['cart'] = $_SESSION['cart']."|".$productnumber.",".$quantity;
    }
}


//forward to cart
header("Location: cart.php");
?> 
