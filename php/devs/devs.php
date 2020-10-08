<?php
session_start();
?>

<!DOCTYPE html>
<html>

    <head>
        <title>User Devs</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../../css/devs.css">
        <link rel="stylesheet" type="text/css" href="../../css/loggedIn.css">
        <script src="../../js/loggedIn.js"></script>
    </head>

    <body class="w3-black">
        <a href="../logout.php"><button class="logoutButton">Log Out</button></a>
        <!-- Icon Bar (Sidebar - hidden on small screens) -->
        <div class="w3-sidebar">
            <!-- Avatar image in top left corner -->
            <a href="../loggedIn.php"><img src="../../images/small-logo.png" style="width:100%"></a>
            <button onclick="myFunction()" class="dropdown-btn">PROJECTS
                <i class="fa fa-caret-down"></i>
            </button>
            <div id="dropdwn" class="dropdown-container">
                <a href="../projects/projects.php">ADD PROJECT</a>
                <a href="../projects/updateProject.php">UPDATE PROJECT</a>
                <a href="../projects/deleteProject.php">DELETE PROJECT</a>
            </div>
            <button onclick="myFunction2()" class="dropdown-btn">DEVS
                <i class="fa fa-caret-down"></i>
            </button>
            <div id="dropdwn2" class="dropdown-container">
                <a href="devs.php">ADD DEV</a>
                <a href="updateDev.php">UPDATE DEV</a>
                <a href="deleteDev.php">DELETE DEV</a>
            </div>
            <button onclick="myFunction3()" class="dropdown-btn">BUGS
                <i class="fa fa-caret-down"></i>
            </button>
            <div id="dropdwn3" class="dropdown-container">
                <a href="../bugs/bugs.php">ADD BUG</a>
                <a href="">UPDATE BUG</a>
                <a href="../bugs/deleteBug.php">DELETE BUG</a>
            </div>
            <a href="../reports.php" class="">
                <p>REPORTS</p>
            </a>
        </div>    

        <!-- Page Content -->

        <div class="projForm">
            <form action="insertDev.php" method="POST" name="devForm">
                <div id="signup-box">  
                    <h1>Add a Developer</h1>
                    <div class="left">
                        <input type="text" name="firstName" placeholder="First Name" required/>
                        <input type="text" name="lastName" placeholder="Last Name" required/>
                        <input type="text" name="phoneNumber" placeholder="Phone Number" required/>
                        <input type="text" name="email" placeholder="Email Address" required/>
                    </div>
                    <div class="teams">
                        <select name="devTeam" required>
                            <option></option>
                            <option value="Full Stack">Full Stack</option>
                            <option value="Front-end">Front-end</option>
                            <option value="Back-end">Back-end</option>
                            <option value="Mobile">Mobile</option>
                            <option value="Q&A">Q&A</option>
                        </select>
                    </div>
                    <input type="submit" class="submitButton" name="signup_submit" value="SIGN UP" />
                </div>
            </form>
        </div>

        <!-- END PAGE CONTENT -->

    </body>

</html>