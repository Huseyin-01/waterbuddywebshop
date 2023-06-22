<?php

$page_title = 'Contact Waterbuddy';

require_once('chosenlanguagecontact.php');

include('header.html');

require('form_validator.php');

if (isset($_POST['submit'])) {
    // hier ga ik de formulier valideren
    $validation = new formValidator($_POST);
    $errors = $validation->validateForm();

    // data toevoegen aan database
    $sql = "INSERT INTO `message_incoming` (`firstname`, `lastname`, `email`, `subject`) VALUES " .
        "('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $_POST['subject'] . "');";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Thank you, you will be redirected!')</script>";
    } else {
        echo "query error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contact.css" type="text/css" media="screen" />
    <title><?php echo $page_title; ?></title>
</head>

<body>
    <div class="contact-form-box">
        <h1><?php echo $language["Contact Form"]; ?></h1>
        <hr>
        <form action="<?php echo $_SERVER['process.php'] ?>" method="POST">
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
            <textarea id="subject" name="subject" placeholder="Write your message here&#42;"><?php echo ($_POST['email']) ?? '' ?></textarea><br>
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