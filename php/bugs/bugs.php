<?php
session_start();
require('../mysqli_connect.php');
$compID = mysqli_real_escape_string($dbLink, trim($_SESSION['companyID']));
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add a Bug</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../../css/bugs.css">
        <link rel="stylesheet" type="text/css" href="../../css/loggedIn.css">
        <script src="../../js/loggedIn.js"></script>
    </head>

    <body class="w3-black">
        <div class="container">
        <a href="../logout.php"><button class="logoutButton">Log Out</button></a>
        </div>
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
                <a href="../devs/devs.php">ADD DEV</a>
                <a href="../devs/updateDev.php">UPDATE DEV</a>
                <a href="../devs/deleteDev.php">DELETE DEV</a>
            </div>
            <button onclick="myFunction3()" class="dropdown-btn">BUGS
                <i class="fa fa-caret-down"></i>
            </button>
            <div id="dropdwn3" class="dropdown-container">
                <a href="bugs.php">ADD BUG</a>
                <a href="">UPDATE BUG</a>
                <a href="deleteBug.php">DELETE BUG</a>
            </div>
            <a href="../reports.php" class="">
                <p>REPORTS</p>
            </a>
        </div>    

        <!-- Page Content -->

        <div class="projForm">
            <form action="insertBug.php" method="POST" name="bugForm">
                <div class="projectBox">
                    <h1>Add a Bug</h1>
                    <input type="text" name="title" placeholder="Title" required/>
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
                    <label for="version" style="margin-left:10px;">Project Version:</label>
                    <select name="version" required>
                        <option></option>
                        <?php
                        $sqlV = "SELECT version FROM projects WHERE companyID = $compID";
                        $re = mysqli_query($dbLink, $sqlV);
                        while ($row = $re->fetch_assoc()) {
                            echo "<option value=" . $row['version'] . ">" . $row['version'] . "</option>";
                        }
                        ?>
                    </select>
                    <label for="reportedBy" style="margin-left:10px;">Reported by:</label>
                    <select name="reportedBy" required>
                        <option></option>
                        <?php
                        $s = "SELECT devID,firstName,lastName FROM devs WHERE companyID = $compID";
                        $result = mysqli_query($dbLink, $s);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=" . $row['devID'] . ">" . $row['firstName'] . " " . $row['lastName'] . "</option>";
                        }
                        ?>
                    </select>
                    <br><br>
                    <label for="type">Type:</label>
                    <select name="type" required>
                        <option></option>
                        <option value="Functionality">Functionality</option>
                        <option value="Communication">Communication</option>
                        <option value="Missing Command">Missing Command</option>
                        <option value="Syntactic">Syntactic</option>
                        <option value="Error Handling">Error Handling</option>
                        <option value="Calculation">Calculation</option>
                        <option value="Control Flow">Control Flow</option>
                        <option value="Other">Other</option>
                    </select>
                    <label for="priority" style="margin-left:10px;">Priority:</label>
                    <select name="priority" required>
                        <option></option>
                        <option value="Urgent">Urgent</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                    <label for="severity" style="margin-left: 10px;">Severity:</label>
                    <select name="severity" required>
                        <option></option>
                        <option value="S1 - Critical">S1 - Critical</option>
                        <option value="S2 - Severe">S2 - Severe</option>
                        <option value="S3 - Medium">S3 - Medium</option>
                        <option value="S4 - Cosmetic/Enhancement">S4 - Cosmetic/Enhancement</option>
                        <option value="S5 - Suggestion">S5 - Suggestion</option>
                    </select>
                    <br><br>
                    <textarea class="description" type="text" name="description" placeholder="Description" required
                              style="resize:none;"></textarea>
                    <textarea class="scenario" type="text" name="scenario" placeholder="Scenario/Recreation Steps" required
                              style="resize:none;"></textarea>
                    <input class="submitButton" type="submit" name="signup_submit" value="SQUASH!"/>
                </div>
            </form>
        </div>

        <!-- END PAGE CONTENT -->

    </body>
</html>