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
//$sql = "SELECT * FROM adminstock";
//$query = $pdo->prepare($sql);
//$query->execute();
//$row = $query->fetch(PDO::FETCH_ASSOC); 
$result = $pdo->query("SELECT * FROM adminstock");
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
    <h4 style="float:right">Available Balance:<?php echo htmlspecialchars($_SESSION["balance"]);?></h4>
    <center><br><br>
    <table id='myTable' style="width:150px;">
 
    <tr bgcolor='#CCCCCC'><th>Product Name</th><th>Product Value</th></tr>
    <?php     
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
        echo "<tr>";
        echo "<td>".$row['product_name']."</td>";
        echo "<td>".$row['product_value']."</td>";
            
    }
    ?>
    </table></center>
    
    <div class="page-header"><br>
    <?php echo $row['product_name'] ?>
    
    <p>
       <!-- <a href="reset-password.php" class="btn">Reset Your Password</a> -->
       <center> <a href="logout.php" class="btn small">Sign Out of Your Account</a></center>
    </p><br/>
    <div>
    <?php include_once("Footer.php") ?>
    </div>

