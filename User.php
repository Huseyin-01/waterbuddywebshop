<?php

include('header.php');
require('CrudUser.php');


$user = new User();

// Example usage: Create a new user
$user->createUser('4', 'paul', 'pas555');

// Example usage: Get all users
$users = $user->getUsers();


echo "<h2>Users</h2>";
echo "<table>";
echo "<tr><th>User ID</th><th>Username</th><th>Password</th><th>Action</th></tr>";
foreach ($users as $userData) {
    echo "<tr>";
    echo "<td>" . $userData['gebruiker_id'] . "</td>";
    echo "<td>" . $userData['gebruikersnaam'] . "</td>";
    echo "<td>" . $userData['wachtwoord'] . "</td>";
    echo "<td>";
    echo "<form method='post'>";
    echo "<input type='hidden' name='userId' value='" . $userData['gebruiker_id'] . "'>";
    echo "<input type='submit' name='deleteUser' value='Delete'>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
echo "</table>";

// Check the form
if (isset($_POST['deleteUser'])) {
    $userId = $_POST['userId'];
    $user->deleteUser($userId);
    exit();
}
