<?php
session_start();
$error = "Username or password is incorrect, please try again."; // Error message
$isError = false; // Default setting for isError is set to false
// Check to make sure form method is POST and values are filled in on form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require('mysqli_connect.php');
    if (!empty($_POST['username'])) {
        $e = mysqli_real_escape_string($dbLink, trim($_POST['username']));
    } else {
        $e = FALSE;
        $isError = true;
    }
    if (!empty($_POST['password'])) {
        $p = mysqli_real_escape_string($dbLink, trim($_POST['password']));
    } else {
        $p = FALSE;
        $isError = true;
    }

    // Check if the username that was entered is a correct username
    $sql = "SELECT username FROM users WHERE username = '$e'";
    if ($sql !== $e) {
        $isError = true; // If username is invalid throw an error
    }

    // If username and password on the form are filled out..
    if ($e && $p) {
        $q = "SELECT companyID, username, hashed_password FROM users WHERE username = '$e'";
        $r = mysqli_query($dbLink, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbLink));

        if (@mysqli_num_rows($r) === 1) {
            // Grab username and password from DB
            list($companyID, $username, $password) = mysqli_fetch_array($r, MYSQLI_NUM);
            mysqli_free_result($r);

            // Check to see if password entered in form matches hashed_password from DB
            if (password_verify($p, $password)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['companyID'] = $companyID;
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                mysqli_close($dbLink); // Close connection to DB
                ob_end_clean();
                header("Location: loggedIn.php"); // Redirect to user homepage
            } else { // If passwords do not match throw error
                $isError = true;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type=text/css href="../css/login.css">

        <!-- SET FOCUS TO USERNAME INPUT -->
        <script type="text/javascript">
            window.onload = function () {
                document.getElementById("username").focus();
            };
        </script>
    </head>

    <body>

        <!-- Page Content -->

        <a href="../index.html"><img src="../images/small-logo.png" style="width:8.8%"></a>

        <div class="error"><?php
            if ($isError) {
                echo $error;
            }
            ?>
        </div>

        <form action="login.php" method="POST" name="loginform">
            <div id="login-box">
                <div class="left">
                    <h1>Login</h1>
                    <input id="username" type="text" name="username" placeholder="Username" required/>
                    <input type="password" name="password" placeholder="Password" required/>
                    <input type="submit" name="login_submit" value="Log me in!" />
                </div>
            </div>
        </form>

        <!-- END PAGE CONTENT -->
    </body>
</html>