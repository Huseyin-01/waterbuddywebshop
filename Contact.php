<?php

$page_title = 'Contact Waterbuddy';

require_once('Languages/Home/chosenlanguage.php');

include('header.php');

include('DbConnection.php');

require('form_validator.php');

if (isset($_POST['submit'])) {
    $dbConnection = new DbConnection();
    $dbConnection->connect();
    $conn = $dbConnection->getConnection();
    // hier ga ik de formulier valideren
    $validation = new formValidator($_POST);
    $errors = $validation->validateForm();

    if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email']) || empty($_POST['subject'])) {
        $errors = $validation->validateForm();
    } else {
        // Prepare the query using placeholders
        $sql = "INSERT INTO `message_incoming` (`firstname`, `lastname`, `email`, `subject`) VALUES (:firstname, :lastname, :email, :subject)";
        $stmt = $conn->prepare($sql);

        // Bind the values to the placeholders
        $stmt->bindValue(':firstname', $_POST['firstname']);
        $stmt->bindValue(':lastname', $_POST['lastname']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':subject', $_POST['subject']);

        // Execute the query
        if ($stmt->execute()) {
            echo '<script>alert("Thank you for your message!")</script>';
        } else {
            echo "query error: " . $stmt->errorInfo()[2];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/Style_Contact.css" type="text/css" media="screen" />
    <title><?php echo $page_title; ?></title>
</head>

<body>
    <div class="contact-form-box">
        <h1><?php echo $language["Contact Form"]; ?></h1>
        <hr>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <label for="fname"><?php echo $language["First Name"]; ?></label><br>
            <input type="text" id="fname" name="firstname" value="<?php echo ($_POST['firstname']) ?? '' ?>"><br>
            <span class="error"><?php echo $errors['firstname'] ?? '' ?> </span><br>
            <label for="lname"><?php echo $language["Last Name"]; ?></label><br>
            <input type="text" id="lname" name="lastname" value="<?php echo ($_POST['lastname']) ?? '' ?>"><br>
            <span class="error"><?php echo $errors['lastname'] ?? '' ?> </span><br>
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email" value="<?php echo ($_POST['email']) ?? '' ?>"><br>
            <span class="error"><?php echo $errors['email'] ?? '' ?> </span><br>
            <label for="subject"><?php echo $language["Subject"]; ?></label><br>
            <textarea id="subject" name="subject" placeholder=<?php echo $language["Write your message here"]; ?>><?php echo ($_POST['email']) ?? '' ?></textarea><br>
            <span class="error"><?php echo $errors['subject'] ?? '' ?> </span><br>
            <button type="submit" name="submit" value="submit"><?php echo $language["Submit"]; ?></button>
        </form>
    </div>
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











<!-- 
// formulier validatie met php

$firstname_error = '';
$lastname_error = '';
$email_error = '';
$subject_error = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['firstname'])) {
        $firstname_error = 'Firstname is required';
    } else {
        if (!preg_match('/^[ a-zA-Z ]*$/', $_POST['firstname'])) {
            $firstname_error = 'Only letters allowed';
        }
    }
    if (empty($_POST['lastname'])) {
        $lastname_error = 'Lastname is required';
    } else {
        if (!preg_match('/^[ a-zA-Z ]*$/', $_POST['lastname'])) {
            $lastname_error = 'Only letters allowed';
        }
    }
    if (empty($_POST['email'])) {
        $email_error = 'Email is required';
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email_error = 'Invalid email format';
        }
    }
    if (empty($_POST['subject'])) {
        $subject_error = 'Message is required';
    }
} -->