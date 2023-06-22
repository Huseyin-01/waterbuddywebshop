<?php
// toevoegen header bestand en verbinding maken met de database bestand
include('header.php');

include('dbconnect.php');

require('SearchHandler.php');

?>

<div class="search-container1">
    <h1>Search Page</h1>
    <?php
    // Zodra de submit knop is geklikt, dan wordt de query uitgevoerd op de database
    if (isset($_POST['submit-search'])) {
        $search = new SearchHandler($conn);
        $search->executeSearch($_POST['search']);
    }
    ?>
</div>



<!-- de query hieronder lukte niet. query error: geen kolom 'hallo' gevonden in de field   list -->
<!-- $query = "INSERT INTO producten (product_id, naam, voorraad, prijs) VALUES (NULL, $zoekterm, 25, 10)"; -->

<!-- deze hoeft niet meer -->
<!-- echo "<div><h3>" . $row['naam'] . "</h3> <p> aantal op voorraad: " . $row['voorraad'] . "</p> <p> bedrag: " . $row['prijs'] . "</p> </div> "; -->