<?php
session_start();
$error = "Project name and version already exists, please try again."; // Error message for duplicate project entry
$errorDB = "Unknown error, please try again."; // Error message for DB
$isError = false; // Default setting for isError is set to false
$isErrorDB = false; // Default setting for isErrorDB is set to false
// Check to make sure form method is POST and values are filled in on form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to DB
    require('../mysqli_connect.php');
    // Create safe variables
    $projectName = mysqli_real_escape_string($dbLink, trim($_POST['projectName']));
    $projectDescription = mysqli_real_escape_string($dbLink, trim($_POST['projectDescription']));
    $version = mysqli_real_escape_string($dbLink, trim($_POST['version']));
    
    // Check to make sure project and version isnt already in DB
    $check = "SELECT * FROM projects WHERE projectName = '$projectName' AND version = '$version'";
    $r = mysqli_query($dbLink, $check);
    if (!$r) {
        $isError = true;
    } else {
        // Create safe variable using $_SESSION company ID 
        $companyID = mysqli_real_escape_string($dbLink, trim($_SESSION['companyID']));
                
        // Insert values into DB
        $sql = "INSERT INTO projects(projectName, projectDescription, companyID, version) "
                . "VALUES('$projectName','$projectDescription','$companyID','$version')";
        $result = mysqli_query($dbLink, $sql);

        // If query is successful redirect to user homepage
        if ($result) {
            mysqli_close($dbLink);
            header("Location: ../loggedIn.php");
            return true; // Success
        } else {
            $isErrorDB = true;
            mysqli_close($dbLink);
            return false; // Error somewhere
        }
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>User Projects</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../../css/projects.css">
        <link rel="stylesheet" type="text/css" href="../../css/loggedIn.css">
        <script src="../../js/loggedIn.js"></script>
    </head>

    <body class="w3-black">

        <!-- LOGOUT BUTTON -->
        <a href="../logout.php"><button class="logoutButton">Log Out</button></a>

        <!-- NAV BAR -->
        <div class="w3-sidebar">
            <!-- Avatar image in top left corner -->
            <a href="../loggedIn.php"><img src="../../images/small-logo.png" style="width:100%"></a>
            <button onclick="myFunction()" class="dropdown-btn">PROJECTS
                <i class="fa fa-caret-down"></i>
            </button>
            <div id="dropdwn" class="dropdown-container">
                <a href="projects.php">ADD PROJECT</a>
                <a href="updateProject.php">UPDATE PROJECT</a>
                <a href="deleteProject.php">DELETE PROJECT</a>
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

        <!-- NAV BAR END -->

        <!-- Page Content -->

        <div class="error"><?php
            if ($isError) {
                echo $error;
            }
            if ($isErrorDB) {
                echo $errorDB;
            }
            ?>
        </div>

        <div class="projForm">
            <form action="" method="POST">
                <div class="projectBox">
                    <h1>Add a Project</h1>
                    <div class="titleVersion">
                    <input type="text" class="title" name="projectName" placeholder="Project Name" required/>
                    <input type="text" class="version" name="version" placeholder="Version" required/>
                    </div>
                    <textarea name="projectDescription" class="description" placeholder="Description" cols="40" rows="8" required></textarea>

                    <input class="submitButton" type="submit" name="submit" value="SUBMIT" />
                </div>
            </form>
        </div>

        <!-- END PAGE CONTENT -->

    </body>

</html>