<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Include config file
require_once "config.php";
$sql = "SELECT * FROM students WHERE id=:id";
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $_SESSION["id"]));
$row = $query->fetch(PDO::FETCH_ASSOC); 
?>
<link rel="stylesheet" href="search.css">
<style type="text/css">
        body{ font: 14px sans-serif;background-color:lightblue }
        .wrapper{ width: 350px; padding: 10px;text-align:left;}
        .help-block{color:red}
    </style>
    <div>
        <?php include_once("Navigation.php")  ?>
    </div> 
    <div class="page-header"><br>
     
    
    <p>
       <!-- <a href="reset-password.php" class="btn">Reset Your Password</a> -->
       <center> <a href="logout.php" class="btn small">Sign Out of Your Account</a></center>
    </p><br/>
    <div>
    <?php include_once("Footer.php") ?>
    </div>

