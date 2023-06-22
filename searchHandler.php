<?php

require('DbConnection.php');

class SearchHandler
{
    private $conn;

    public function __construct()
    {
        $dbConnection = new DbConnection();
        $dbConnection->connect();
        $this->conn = $dbConnection->getConnection();
    }

    public function executeSearch($search)
    {
        $search = "%$search%";

        $sql = "SELECT * FROM `zoekresultaten` WHERE `naam` LIKE :search OR `voorraad` LIKE :search OR `prijs` LIKE :search";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':search', $search, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $queryResult = $stmt->rowCount();

            echo "<h3>There are " . $queryResult . " results!</h3>";

            if ($queryResult > 0) {
                echo "<table>\n<thead><th>Productname</th><th>Stock</th><th>Price</th></thead>\n<tbody>";

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row["naam"] . "</td>";
                    echo "<td>€ " . $row["voorraad"] . "</td>";
                    echo "<td> " . $row["prijs"] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "There are no results matching your search!<br>";

                $query = "INSERT INTO `zoektermen` (`zoekterm`) VALUES (:search)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':search', $_POST['search'], PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo '<script>alert("There are no results matching your search!")</script>';
                } else {
                    echo 'Query error: ' . $stmt->errorInfo()[2];
                }
            }
        } else {
            echo 'Query error: ' . $stmt->errorInfo()[2];
        }
    }
}
