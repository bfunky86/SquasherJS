<?php
session_start();
require('../mysqli_connect.php');
$isError = false; // Default setting false for boolean $isError
$errorDB = "Unknown error, please try again."; // Error message for DB
// Check to make sure SESSION variable is set, if not redirect to login.php
if (!isset($_SESSION['companyID'])) {
    header("Location: ../login.php");
} else {
    // Create safe variable using $_SESSION companyID variable
    $compID = mysqli_real_escape_string($dbLink, trim($_SESSION['companyID']));

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Create safe variables
        $existingProj = mysqli_real_escape_string($dbLink, trim($_POST['projects']));
        $newProjName = mysqli_real_escape_string($dbLink, trim($_POST['newTitle']));
        $newProjDesc = mysqli_real_escape_string($dbLink, trim($_POST['newProjDescription']));
        $newVersion = mysqli_real_escape_string($dbLink, trim($_POST['newVersion']));

        // SQL statement for update value in DB
        $s = "UPDATE projects SET projectName = '$newProjName', projectDescription = '$newProjDesc', "
                . "version = '$newVersion' WHERE projectName = '$existingProj'";
        $r = mysqli_query($dbLink, $s);

        if ($r) { // If no errors
            mysqli_close($dbLink); // Close the DB
            header("Location: ../loggedIn.php"); // Redirect to user homepage
        } else {
            mysqli_close($dbLink); // Close the DB
            $isError = true; // Change boolean $isError to true for output to page
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Project</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../../css/updateProject.css">
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
                <a href="../devs/devs.php">ADD DEV</a>
                <a href="../devs/updateDev.php">UPDATE DEV</a>
                <a href="../devs/deleteDev.php">DELETE DEV</a>
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
        
        <!-- Error output if DB errors are found -->
        <div class="error">
            <?php
            if ($isError) {
                echo $errorDB;
            }
            ?>
        </div>
        
        
        <div class="updateProjForm">
            <form method="POST" name="updateProjForm">
                <div class="projectBox">
                    <h1>Update Project</h1>
                    <label for="projects">Choose a Project:</label>
                    <select name="projects" required>
                        <option></option>
                        <?php
                        $sql = "SELECT projectName FROM projects WHERE companyID = $compID";
                        $r = mysqli_query($dbLink, $sql);
                        while ($row = $r->fetch_assoc()) {
                            echo "<option value=" . $row['projectName'] . ">" . $row['projectName'] . "</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <div class="titleVersion">
                    <input type="text" class="title" name="newTitle" placeholder="Update Project Name" required/>
                    <input type="text" class="version" name="newVersion" placeholder="Update Project Version" required/>
                    </div>
                    <div class="container">
                        <textarea name="newProjDescription" class="description" placeholder="Update Description" cols="40" rows="8" required></textarea>
                    </div>
                    <input class="submitButton" type="submit" name="signup_submit" value="UPDATE"/>
                </div>
            </form>
        </div>

        <!-- END PAGE CONTENT -->

    </body>
</html>