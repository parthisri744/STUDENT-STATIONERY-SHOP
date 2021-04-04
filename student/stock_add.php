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
     <h4 style="float:right">Available Balance:<?php echo $row['balance'] ?> </h4>
     <div class="wrapper">
     <span style="color:red;font-size:small;" id="pname_err"></span>
            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" name="myForm" onsubmit="return validateForm()" method="post" id="contact-form">
            <div class="form-group">
                <label>Enter the Product name</label>
                <select name="product_name" id="course" class="form-control">
                <option value="0">Please Select </option>
                <option value="Pencil">Pencil </option>
                <option value="Pen">Pen </option>
                <option value="Note Book">Note Book </option>
                </select>
                                
            </div>    
            <div class="form-group">
                <label>Enter the number of Quantity</label>
                <input type="text" name="quantity" class="form-control">
                
                
            </div>
            <div class="form-group">
                <label>Pay Amount</label>
                <input type="text" name="amount" class="form-control">
                              
            </div>
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="Save & Next"><a class="btn" style="background-color:red;" href="welcome.php">Cancel</a>
            </div>
        </form>
    <p>
       <!-- <a href="reset-password.php" class="btn">Reset Your Password</a> -->
       <center> <a href="logout.php" class="btn small">Sign Out of Your Account</a></center>
    </p><br/>
    <div>
    <?php include_once("Footer.php") ?>
    </div>
    <script>
function validateForm() {
  var product_name = document.forms["myForm"]["product_name"].value;
  if (product_name == 0) {
    swal('Error','Please Select the Product Name','error');
    document.getElementById("pname").innerHTML="Please Enter Register No ";
    return false;
  }
  var quantity = document.forms["myForm"]["quantity"].value;
  if (quantity == "") {
    swal('Error','Please Enter Number of Quantity','error');
    document.getElementById("quantity_err").innerHTML="Please Enter Student Name ";
    return false;
  }
  var dob = document.forms["myForm"]["dob"].value;
  if (dob == "") {
    swal('Error','Please Enter Date Of Birth','error');
    document.getElementById("error").innerHTML="Please Enter Date Of Birth ";
    return false;
  }
}
</script>

