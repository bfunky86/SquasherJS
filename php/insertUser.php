<?php

include('myFunctions.php');
// Connect to DB
require('mysqli_connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create safe variables
    $username = mysqli_real_escape_string($dbLink, trim($_POST['username']));
    $password = mysqli_real_escape_string($dbLink, trim($_POST['password']));
    $password2 = mysqli_real_escape_string($dbLink, trim($_POST['password2']));
    $email = mysqli_real_escape_string($dbLink, trim($_POST['email']));

    //valid_pws function in a var
    $pwerr = valid_pws($password, $password2);

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    if ($pwerr === true) {
        //if true create user
        if (create_user($username, $hashed_password, $email, $dbLink)) {
            // Close the DB
            mysqli_close($dbLink);
            header("Location: login.php");
        }
    } else {
        //close the database
        mysqli_close($dbLink);
        // If there was an error, redirect
        header("Location: signup.php");
    }
}
?>
