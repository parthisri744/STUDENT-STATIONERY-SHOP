<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
function decrypt($ivHashCiphertext, $password) {
    $method = "AES-256-CBC";
    $iv = substr($ivHashCiphertext, 0, 16);
    $hash = substr($ivHashCiphertext, 16, 32);
    $ciphertext = substr($ivHashCiphertext, 48);
    $key = hash('sha256', $password, true);
    //echo "Inside Function".$ivHashCiphertext."Key :".$password;
  
    if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
    //echo " jhjkhj".openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
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
    <div class="page-header" align="center">
    <h1>Student Details</h1>
     <table id="myTable" style="width:700px">
    <tr>
    <td>Student Name<td>:<td><?php echo decrypt(base64_decode(($row['sname'])),'ucensss');   ?>
    </tr>
    <tr>
    <td>Student Register Number<td>:<td><?php echo $row['regno'] ?>
    </tr>
    <tr>
    <td>Student Date of Birth<td>:<td><?php echo $row['dob'] ?>
    </tr>
    <tr>
    <td>Course<td>:<td><?php echo $row['course'] ?>
    </tr>
    <tr>
    <td>Branch<td>:<td><?php echo $row['branch'] ?>
    </tr>
    <tr>
    <td>Current Year<td>:<td><?php echo $row['syear'] ?>
    </tr>
    <tr>
    <td>Phone Number<td>:<td><?php echo decrypt(base64_decode(($row['phno'])),'ucensss');  ?>
    </tr>
    <tr>
    <td>Student Address<td>:<td><?php echo $row['stu_address'] ?>
    </tr>
    <tr>
    <td>Student Email<td>:<td><?php echo decrypt(base64_decode(($row['email'])),'ucensss'); ?>
    </tr>
    </table>
    
    <p>
       <!-- <a href="reset-password.php" class="btn">Reset Your Password</a> -->
       <center> <a href="logout.php" class="btn small">Sign Out of Your Account</a></center>
    </p><br/>
    <div>
    <?php include_once("Footer.php") ?>
    </div>

