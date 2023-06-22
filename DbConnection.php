<?php

class DbConnection
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "waterbuddy_store";
    private $connection;

    public function connect()
    {
        try {
            $this->connection = new PDO(
                "mysql:host=$this->servername;dbname=$this->dbname;unix_socket=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock",
                $this->username,
                $this->password
            );

            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to the database successfully";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function disconnect()
    {
        $this->connection = null;
        echo "Disconnected from the database";
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
