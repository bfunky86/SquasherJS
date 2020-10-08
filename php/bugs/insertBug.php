<?php
session_start();
    // Connect to DB
require('../mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Create safe variables
    $bugTitle = mysqli_real_escape_string($dbLink, trim($_POST['title']));
    $projectName = mysqli_real_escape_string($dbLink, trim($_POST['projects']));
    
    $sql = "SELECT projectID FROM projects WHERE projectName = '$projectName' LIMIT 1";
    $result = mysqli_query($dbLink,$sql);
    $row = mysqli_fetch_array($result);
    
    $projectID = mysqli_real_escape_string($dbLink, trim($row['projectID']));
    $reportedBy = mysqli_real_escape_string($dbLink, trim($_POST['reportedBy']));
    $bugType = mysqli_real_escape_string($dbLink, trim($_POST['type']));
    $priority = mysqli_real_escape_string($dbLink, trim($_POST['priority']));
    $severityLevel = mysqli_real_escape_string($dbLink, trim($_POST['severity']));
    $description = mysqli_real_escape_string($dbLink, trim($_POST['description']));
    $scenario = mysqli_real_escape_string($dbLink, trim($_POST['scenario']));
    $companyID = mysqli_real_escape_string($dbLink, trim($_SESSION['companyID']));
    $version = mysqli_real_escape_string($dbLink, trim($_POST['version']));
    
    $query = "INSERT INTO bugs (bugTitle, reportedBy, bugType, priority, severityLevel, description, scenario, projectID, companyID, version)"
            . "VALUES('$bugTitle','$reportedBy','$bugType','$priority','$severityLevel','$description','$scenario','$projectID','$companyID','$version')";
    
    $r = mysqli_query($dbLink, $query);
            
     if ($r) {
        mysqli_close($dbLink);
        header("Location: ../loggedIn.php");
        return true;  // Success
    } else {
        mysqli_close($dbLink);
        header("Location: ../../index.html");
        return false; // Error somewhere
    }
}
?>