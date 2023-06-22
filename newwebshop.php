<?php

// Include the DbConnection class file
require_once('DbConnection.php');

class Webshop
{
    private $dbConnection;

    public function __construct()
    {
        // Create a new instance of DbConnection
        $this->dbConnection = new DbConnection();
    }

    public function displayProducts()
    {
        try {
            // Call the connect method to establish the database connection
            $this->dbConnection->connect();

            // Get the PDO connection object from the DbConnection instance
            $conn = $this->dbConnection->getConnection();

            // Maak de SQL query die onze producten gaat opleveren.
            $sql = "SELECT 
                `products`.`productnumber`, 
                `products`.`productname`, 
                `products`.`price`, 
                `products`.`description`,
                `products`.`deliverable`, 
                `products`.`stock`, 
                `product_images`.`image_id`
            FROM `products`, `product_images`
            WHERE `products`.`productnumber` = `product_images`.`productnumber`
            GROUP BY `productname`
            ORDER BY `productname`;";

            // Prepare the statement
            $stmt = $conn->prepare($sql);

            // Execute the query
            $stmt->execute();

            // Fetch all rows
            $result = $stmt->fetchAll();

            if (empty($result)) {
                echo "<p>No products could be found in the store.</p>\n";
            } else {
                // Laat de producten zien in een form, zodat de gebruiker ze kan selecteren.
                foreach ($result as $row) {
                    echo "<!-- ---------------------------------- -->\n";
                    echo "<div id=\"product\">\n<form id='itemform' action=\"add.php\" method=\"post\">\n";
                    echo "<input type=\"hidden\" name=\"productnumber\" value=\"" . $row["productnumber"] . "\" />\n";

                    echo '<p><img id=\'image\' src="showfile.php?image_id=' . $row["image_id"] . '"></p>';

                    echo "<div id=\"price\">€ " . number_format($row["price"], 2, ',', '.') . "</div><br>\n";
                    echo "<div id=\"prodname\">" . $row["productname"] . "</div><br>\n";
                    echo "<div id=\"description\">" . $row["description"] . "</div><br>\n";
                    echo "<div id=\"deliverable\">Deliverable: " . $row["deliverable"] . "</div>\n";
                    echo "<div id=\"stock\">Stock: " . $row["stock"] . "</div>\n";
                    echo "<div id=\"select\">Quantity: <input type=\"text\" name=\"quantity\" size=\"2\" maxlength=\"2\" value=\"1\" />";
                    echo "<input type=\"submit\" value=\"Order\" class=\"buttonBuyNowBasic\" /></div>\n";
                    echo "</form>\n</div>\n";
                }
            }
        } catch (PDOException $e) {
            echo "<p><b>Error: connecting to the database failed.</b><br/>\n" . $e->getMessage() . "</p>\n";
            exit();
        } finally {
            // Close the database connection
            $this->dbConnection->disconnect();
        }
    }
}
