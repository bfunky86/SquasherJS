<?php
if (!empty($_SESSION['logged_in'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type=text/css href="../css/signup.css">
        <script src="../js/signup.js"></script>
    </head>

    <body>

        <!-- Page Content -->

        <a href="../index.html"><img src="../images/small-logo.png" style="width:8.8%"></a>
        <form action="../php/insertUser.php" method="POST" name="signupform">

            <div id="signup-box">
                <div class="left">
                    <h1>Sign Up</h1>

                    <input type="text" name="username" placeholder="Username" required/>
                    <input type="text" name="email" placeholder="E-mail" required/>
                    <input type="password" name="password" id="password" placeholder="Password" onkeyup="check();" required/>
                    <input type="password" name="password2" id="confirm_password" placeholder="Retype password" onkeyup="check();" required/>
                    <div id="message"></div>
                    <input type="submit" class="signup" name="signup_submit" value="Sign me up!" /><a class="member" href="login.php">Already a member?</a>

                </div>

                <div class="right">
                    <span class="loginwith">Sign in with<br />social network</span>


                    <!-- ON LIVE WEBSITE I WOULD ADD FUNCTIONALITY TO LOGIN USING FACEBOOK, TWITTER, AND GOOGLE+ CREDENTIALS -->
                    <a href="www.facebook.com"><button class="social-signin facebook">Log in with Facebook</button></a>
                    <a href="www.twitter.com"><button class="social-signin twitter">Log in with Twitter</button></a>
                    <a href="www.google.com"><button class="social-signin google">Log in with Google+</button></a>
                </div>
                <div class="or">OR</div>
            </div>
        </form>

        <!-- END OF PAGE CONTENT -->

    </body>
</html>