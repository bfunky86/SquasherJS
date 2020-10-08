<?php

// Validate password
function valid_pws($password, $password2) {

// Validate pws.
    if (empty($password || $password2)) {
        return false;
    } else if ($password !== $password2) {
// error matching passwords
        return false;
    } else {
        return true; // passwords match
    }
}

// Create a user
function create_user($username, $password, $email, $dbLink) {
    $query = "INSERT INTO users(username, hashed_password, email) VALUES('$username','$password', '$email')";
    $result = @mysqli_query($dbLink, $query);

    if ($result) {
        return true;  // Success
    } else {
        return false; // Error somewhere
    }
}