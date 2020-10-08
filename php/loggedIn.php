<!DOCTYPE html>
<?php
session_start();
if (!empty($_SESSION['logged_in'])) {
    ?>
    <html>

        <head>
            <title>User Home</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link rel="stylesheet" type=text/css href="../css/loggedIn.css">
            <script src="../js/loggedIn.js"></script>
        </head>

        <body class="w3-black">
            <!-- Icon Bar (Sidebar - hidden on small screens) -->  
            
            <div class="w3-sidebar">
                <!-- Avatar image in top left corner -->
                <a href="loggedIn.php"><img src="../images/small-logo.png" style="width:100%"></a>
                <button onclick="myFunction()" class="dropdown-btn">PROJECTS
                    <i class="fa fa-caret-down"></i>
                </button>
                    <div id="dropdwn" class="dropdown-container">
                        <a href="projects/projects.php">ADD PROJECT</a>
                        <a href="projects/updateProject.php">UPDATE PROJECT</a>
                        <a href="projects/deleteProject.php">DELETE PROJECT</a>
                    </div>
                <button onclick="myFunction2()" class="dropdown-btn">DEVS
                    <i class="fa fa-caret-down"></i>
                </button>
                    <div id="dropdwn2" class="dropdown-container">
                        <a href="devs/devs.php">ADD DEV</a>
                        <a href="devs/updateDev.php">UPDATE DEV</a>
                        <a href="devs/deleteDev.php">DELETE DEV</a>
                    </div>
                <button onclick="myFunction3()" class="dropdown-btn">BUGS
                    <i class="fa fa-caret-down"></i>
                </button>
                    <div id="dropdwn3" class="dropdown-container">
                        <a href="bugs/bugs.php">ADD BUG</a>
                        <a href="">UPDATE BUG</a>
                        <a href="bugs/deleteBug.php">DELETE BUG</a>
                    </div>
                <a href="reports.php" class="">
                    <p>REPORTS</p>
                </a>
            </div>
            
            <a href="logout.php"><button class="logoutButton">Log Out</button></a>         

            <div class="logo">
                <img src="../images/logo.png" alt="SquashR logo">
            </div>
            
        </body>
    </html>
    <?php
} else {
    echo "You are not logged in. <a href='login.php'>Click here</a> to log in.";
}
?>