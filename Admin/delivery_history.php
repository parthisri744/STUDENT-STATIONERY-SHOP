<?php
include_once("config.php");
 require_once "config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
}  
include("Navigation.php")
?>
<link rel="stylesheet" href="search.css">
<div align="center">
    <h1 >Dispatched Details</h1>
    <table id='myTable' style="width:800px">
        <tr class='header' ><th>Name</th><th scope='col'>Register Number</th><th>Current Status</th></tr>
 
    <?php     
    $sql="SELECT ID,Stu_name,stu_regno,status FROM purchase WHERE status='Delivered Successfully'";
    $result = $pdo->prepare($sql);
    $result->execute();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
        echo "<tr>";
        echo "<td>".$row['Stu_name']."</td>";
        echo "<td>".$row['stu_regno']."</td>";
        echo "<td>".$row['status']."</td>";    
        $furl= "delivery.php?id=".$row['ID'];    
    }
    ?>
    </div>
    </table>
    <br/>
    <div>
 <?php include_once("Footer.php") ?>
</div>