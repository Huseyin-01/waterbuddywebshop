<?php

require_once('DbConnection.php');
require_once('DbUser.php');

class User
{
    private $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new DbConnection();
        $this->dbConnection->connect();
    }

    public function createUser($id, $gebruikersnaam, $wachtwoord)
    {
        $conn = $this->dbConnection->getConnection();

        $existingUser = $this->getUserById($id);
        if ($existingUser) {
            echo "User with ID $id already exists.";
            return;
        }

        $sql = "INSERT INTO gebruikers (gebruiker_id, gebruikersnaam, wachtwoord) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id, $gebruikersnaam, $wachtwoord]);

        $user = $this->getUserById($id);
        var_dump($user); die;
        if ($user) {
            echo "User created successfully.";
            return $user;
        } else {
            echo "Failed to create user.";
            return null;
        }
    }

    public function getUsers()
    {
        $conn = $this->dbConnection->getConnection();
        $sql = "SELECT * FROM gebruikers";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function getUserById($id)
    {
        $conn = $this->dbConnection->getConnection();
        $sql = "SELECT * FROM gebruikers WHERE gebruiker_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $gebruikersnaam, $wachtwoord)
    {
        $conn = $this->dbConnection->getConnection();
        $sql = "UPDATE gebruikers SET gebruikersnaam = ?, wachtwoord = ? WHERE gebruiker_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$gebruikersnaam, $wachtwoord, $id]);
        return $stmt->rowCount();
    }

    public function deleteUser($id)
    {
        $conn = $this->dbConnection->getConnection();
        $sql = "DELETE FROM gebruikers WHERE gebruiker_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
