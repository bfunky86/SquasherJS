<?php
session_start();
unset($_SESSION['logged_in']); 
session_destroy();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Logout</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type=text/css href="../css/logout.css">
    </head>

    <body class="w3-black">

        <div class="message">
            <?php
            echo "You have been logged out.";
            ?>
        </div>
        <div class="homeButton">
            <a class="homeLink" href="../index.html">Home</a>
        </div>

    </body>
</html>