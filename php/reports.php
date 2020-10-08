<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to DB
    require('mysqli_connect.php');

    // Create safe variables
    $type = mysqli_real_escape_string($dbLink, trim($_POST['type']));
    $sort = mysqli_real_escape_string($dbLink, trim($_POST['sort']));
    $id = mysqli_real_escape_string($dbLink, trim($_SESSION['companyID']));

    // SQL Selects to view tables for Projects, Devs, and Bugs
    $sqlProjAsc = "SELECT * FROM projects WHERE companyID = $id";
    $sqlProjDesc = "SELECT * FROM projects WHERE companyID = $id ORDER BY projectID DESC";
    $sqlDevAsc = "SELECT * FROM devs WHERE companyID = $id";
    $sqlDevDesc = "SELECT * FROM devs WHERE companyID = $id ORDER BY devID DESC";
    $sqlBugAsc = "SELECT * FROM bugs WHERE companyID = $id";
    $sqlBugDesc = "SELECT * FROM bugs WHERE companyID = $id ORDER BY bugID DESC";


    // If user selects to view projects a table for projects is created
    if ($type === 'PROJECTS') {
        if ($sort === 'ASC' || $sort === "") {
            $result = mysqli_query($dbLink, $sqlProjAsc);
        } else {
            $result = mysqli_query($dbLink, $sqlProjDesc);
        }
        echo '<table border="0" cellspacing="2" cellpadding="2" id="reportTable"> 
      <tr> 
          <td>Project ID</td> 
          <td>Project Name</td> 
          <td>Project Description</td>
          <td>Company ID</td>
          <td>Version</td>
          <td>Creation Date</td>
      </tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            $fieldOne = $row['projectID'];
            $fieldTwo = $row['projectName'];
            $fieldThree = $row['projectDescription'];
            $fieldFour = $row['companyID'];
            $fieldFive = $row['version'];
            $fieldSix = $row['dateCreated'];

            echo '<tr> 
                  <td>' . $fieldOne . '</td> 
                  <td>' . $fieldTwo . '</td> 
                  <td>' . $fieldThree . '</td>
                  <td>' . $fieldFour . '</td>
                  <td>' . $fieldFive . '</td>
                  <td>' . $fieldSix . '</td>
              </tr>';
        }
        $result->free();
    } else if ($type === 'DEVS') { // If user selects to view devs a table for devs is created
        if ($sort === 'ASC' || $sort === "") {
            $result = mysqli_query($dbLink, $sqlDevAsc);
        } else {
            $result = mysqli_query($dbLink, $sqlDevDesc);
        }

        echo '<table border="0" cellspacing="2" cellpadding="2" class="clear-onclick"> 
        <tr> 
            <td>Dev ID</td> 
            <td>First Name</td> 
            <td>Last Name</td>
            <td>Phone Number</td>
            <td>Email</td>
            <td>Developer Team</td>
        </tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            $fieldOne = $row['devID'];
            $fieldTwo = $row['firstName'];
            $fieldThree = $row['lastName'];
            $fieldFour = $row['phoneNumber'];
            $fieldFive = $row['email'];
            $fieldSix = $row['devTeam'];

            echo '<tr> 
                  <td>' . $fieldOne . '</td> 
                  <td>' . $fieldTwo . '</td> 
                  <td>' . $fieldThree . '</td>
                  <td>' . $fieldFour . '</td>
                  <td>' . $fieldFive . '</td>
                  <td>' . $fieldSix . '</td>
              </tr>';
        }
        $result->free();
    } else if ($type === 'BUGS') { // If user selects to view bugs a table for bugs is created
        if ($sort === 'ASC' || $sort === "") {
            $result = mysqli_query($dbLink, $sqlBugAsc);
        } else {
            $result = mysqli_query($dbLink, $sqlBugDesc);
        }
        echo '<table border="0" cellspacing="2" cellpadding="2" class="clear-onclick"> 
        <tr> 
            <td>Bug ID</td> 
            <td>Bug Title</td> 
            <td>Reported By</td>
            <td>Bug Type</td>
            <td>Priority</td>
            <td>Severity Level</td>
            <td>Description</td>
            <td>Scenario</td>
            <td>Project ID</td>
            <td>Project Version</td>
            <td>Creation Date</td>
        </tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            $fieldOne = $row['bugID'];
            $fieldTwo = $row['bugTitle'];
            $fieldThree = $row['reportedBy'];
            $fieldFour = $row['bugType'];
            $fieldFive = $row['priority'];
            $fieldSix = $row['severityLevel'];
            $fieldSeven = $row['description'];
            $fieldEight = $row['scenario'];
            $fieldNine = $row['projectID'];
            $fieldTen = $row['version'];
            $fieldEleven = $row['dateCreated'];

            echo '<tr> 
                  <td>' . $fieldOne . '</td> 
                  <td>' . $fieldTwo . '</td> 
                  <td>' . $fieldThree . '</td>
                  <td>' . $fieldFour . '</td>
                  <td>' . $fieldFive . '</td>
                  <td>' . $fieldSix . '</td>
                  <td>' . $fieldSeven . '</td>
                  <td>' . $fieldEight . '</td>
                  <td>' . $fieldNine . '</td>
                  <td>' . $fieldTen . '</td>
                  <td>' . $fieldEleven . '</td>
              </tr>';
        }
        $result->free();
    } else {
        echo '';
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Reports</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type=text/css href="../css/reports.css">
        <link rel="stylesheet" type="text/css" href="../css/loggedIn.css">
        <script src="../js/reports.js"></script>
        <script src="../js/loggedIn.js"></script>
    </head>

    <body class="w3-black">

        <!-- LOGOUT BUTTON -->
        <a href="logout.php"><button class="logoutButton">Log Out</button></a>

        <!-- NAV BAR -->
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
        <!-- NAV BAR END -->


        <!-- PAGE CONTENT -->

        <br><br>
        <div class="reportsForm">
            <form action="" name="reports" method="POST">
                <label name="reports">REPORTS: </label>    
                <select name="type">
                    <option></option>
                    <option value="PROJECTS">PROJECTS</option>
                    <option value="DEVS">DEVS</option>
                    <option value="BUGS">BUGS</option>
                </select>
                <select name="sort">
                    <option></option>
                    <option value="ASC">ASC</option>
                    <option value="DESC">DESC</option>
                </select>
                <input class="submitButton" type="submit" name="submit" value="SUBMIT"/>
                <input class="clearButton" id="clear" type="submit" onclick="ToggleTable();" name="clear" value="CLEAR"/>
            </form>
        </div>

        <!-- END OF PAGE CONTENT -->
    </body>
</html>