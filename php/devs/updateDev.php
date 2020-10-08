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
        $newFirstName = mysqli_real_escape_string($dbLink, trim($_POST['newFirstName']));
        $newLastName = mysqli_real_escape_string($dbLink, trim($_POST['newLastName']));
        $newPhoneNumber = mysqli_real_escape_string($dbLink, trim($_POST['newPhoneNumber']));
        $newEmail = mysqli_real_escape_string($dbLink, trim($_POST['newEmail']));
        $newDevTeam = mysqli_real_escape_string($dbLink, trim($_POST['newDevTeam']));
        $devID = mysqli_real_escape_string($dbLink, trim($_POST['existingDev']));

        // SQL statement for update value in DB
        $s = "UPDATE devs SET firstName = '$newFirstName', lastName = '$newLastName', "
                . "phoneNumber = '$newPhoneNumber', email = '$newEmail', devTeam = '$newDevTeam' WHERE devID = '$devID'";
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
        <title>User Update Devs</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../../css/updateDev.css">
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
            <form method="POST" name="devForm">
                <div id="signup-box">  
                    <h1>Update a Developer</h1>
                    <div class="left">
                        <label for="dev">Choose a Dev:</label>
                        <br>
                        <select name="existingDev" required>
                            <option></option>
                            <?php
                            $sql = "SELECT * FROM devs WHERE companyID = $compID";
                            $r = mysqli_query($dbLink, $sql);
                            while ($row = $r->fetch_assoc()) {
                                echo "<option value=" . $row['devID'] . ">" 
                                        . $row['firstName'] . " " . $row['lastName'] ."</option>";
                            }
                            ?>
                        </select>
                        <br><br>
                        <input type="text" name="newFirstName" placeholder="Update First Name" required/>
                        <input type="text" name="newLastName" placeholder="Update Last Name" required/>
                        <input type="text" name="newPhoneNumber" placeholder="Update Phone Number" required/>
                        <input type="text" name="newEmail" placeholder="Update Email Address" required/>
                    </div>
                    <div class="teams">
                        <select name="newDevTeam" required>
                            <option></option>
                            <option value="Full Stack">Full Stack</option>
                            <option value="Front-end">Front-end</option>
                            <option value="Back-end">Back-end</option>
                            <option value="Mobile">Mobile</option>
                            <option value="Q&A">Q&A</option>
                        </select>
                    </div>
                    <input type="submit" class="submitButton" name="signup_submit" value="UPDATE" />
                </div>
            </form>
        </div>

        <!-- END PAGE CONTENT -->

    </body>

</html>