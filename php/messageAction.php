<?php

session_start();
if (!isset($_SESSION['companyID'])) {
    header("Location: login.php");
} else {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Connect to DB
        require('mysqli_connect.php');
        // Create safe variables
        $fullname = mysqli_real_escape_string($dbLink, trim($_POST['Name']));
        $email = mysqli_real_escape_string($dbLink, trim($_POST['Email']));
        $subject = mysqli_real_escape_string($dbLink, trim($_POST ['Subject']));
        $message = mysqli_real_escape_string($dbLink, trim($_POST['Message']));

        // SQL Insert statement to enter values in DB
        $sql = "INSERT INTO messages(fullname, email, subject, message) VALUES('$fullname','$email','$subject','$message')";
        $result = mysqli_query($dbLink, $sql);

        if ($result) { // If it works
            mysqli_close($dbLink); // Close the DB
            header("Location: ../messageConfirm.html"); // Redirect to messageConfirm.html
            return true; // Success!
        } else {
            mysqli_close($dbLink); // Close the DB
            header("Location: ../index.html"); // Redirect to website homepage
            return false; // Error somewhere
        }
    }
}
?>