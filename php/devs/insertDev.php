<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to DB
    require('../mysqli_connect.php');
    // Create safe variables
    $firstName = mysqli_real_escape_string($dbLink, trim($_POST['firstName']));
    $lastName = mysqli_real_escape_string($dbLink, trim($_POST['lastName']));
    $phoneNumber = mysqli_real_escape_string($dbLink, trim($_POST ['phoneNumber']));
    $email = mysqli_real_escape_string($dbLink, trim($_POST['email']));
    $companyID = mysqli_real_escape_string($dbLink, trim($_SESSION['companyID']));
    $devTeam = mysqli_real_escape_string($dbLink, trim($_POST['devTeam']));
    
    $query = "INSERT INTO devs (firstName, lastName, phoneNumber, email, companyID, devTeam)"
            . " VALUES('$firstName','$lastName','$phoneNumber','$email','$companyID','$devTeam')";
    $result = mysqli_query($dbLink, $query);
    
    if ($result) {
        header("Location: ../loggedIn.php");
        mysqli_close($dbLink);
        return true;  // Success
    } else {
        mysqli_close($dbLink);
        header("Location: ../../index.html");
        return false; // Error somewhere
    }
}
?>