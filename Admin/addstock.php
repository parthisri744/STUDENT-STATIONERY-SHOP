<?php
require_once "config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$product_name=isset($_POST["product_name"]) ? trim($_POST["product_name"]) : "";
$product_quantity = isset($_POST["product_quantity"]) ? trim($_POST["product_quantity"]) : "";
$product_price= isset($_POST["product_price"]) ? trim($_POST["product_price"]) : "";
$newsql = "ALTER TABLE purchase ADD $product_name varchar(255)";
//echo $newsql;
$st = $pdo->prepare($newsql);
if($product_name!="") {
if($st->execute()){
$sql="INSERT INTO adminstock (product_name,product_quantity,product_price) VALUES (:product_name,:product_quantity,:product_price)";
$result = $pdo->prepare($sql);
$result->bindParam(":product_name", $product_name, PDO::PARAM_STR);
$result->bindParam(":product_quantity", $product_quantity, PDO::PARAM_STR);
$result->bindParam(":product_price", $product_price , PDO::PARAM_STR);
if($product_name!="" && $product_quantity!="" && $product_price!=""){
if($result->execute()) {
  $lastin_id=$pdo->lastInsertId();  ?> 
            <script>
            setTimeout(function() {
            swal({
            title: "Success!",
            text: "Stock Added Successfuly !!",
            type: "success"
          }, function() {
            window.location = "stockview.php";
            });
              }, 100);
            </script> <?php
}else { 
  echo "<script>
  swal('Error','Unable To Insert Data','error');
  </script>";
}
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Stocks</title>
  <link href='sweetalert/sweetalert.css' type='text/css' rel='stylesheet'>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
  <script src='sweetalert/sweetalert.min.js' type='text/javascript'></script>
  <style type="text/css">
        body{ font: 14px sans-serif;background-color:lightblue }
        .wrapper{ width: 350px; padding: 10px;text-align:left;}
        .help-block{color:red}
    </style>
</head>
<body>
     <div>
        <?php include_once("Navigation.php")  ?>
        </div>
        <div class="page-header"  align="center">
        <img src="assets/img/stationery.png" alt="Anna University" width="200px" width="200px">
        <h2>Add New Stocks</h2>
        <span style="color:red" id="error"></span>
        <div class="wrapper">
            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" name="myForm" onsubmit="return validateForm()" method="post" id="contact-form">
            <div class="form-group">
                <label>Enter Product Name</label>
                <input type="text" name="product_name"  class="form-control" autofocus>
                
            </div>    
            <div class="form-group">
                <label>Enter Product Quantity</label>
                <input type="number"  name="product_quantity" autocomplete="off" class="form-control">
                
            </div>
            <div class="form-group">
                <label>Enter Product Price</label>
                <input type="number" name="product_price" class="form-control">
               
            </div>
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="Save & Next"><a class="btn" style="background-color:red;" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
<div>
 <?php include_once("Footer.php") ?>
</div>

<script>
function validateForm() {
  var product_name = document.forms["myForm"]["product_name"].value;
  if (product_name === "") {
    swal('Error','Please Enter Product Name','error');
    document.getElementById("error").innerHTML="Please Enter Product Name";
    return false;
  }
  if (product_quantity === "") {
  var product_quantity = document.forms["myForm"]["product_quantity"].value;
    swal('Error','Please Enter Product  Quantity','error');
    document.getElementById("error").innerHTML="Please Enter Product Quantity ";
    return false;
  }
  var product_price = document.forms["myForm"]["product_price"].value;
  if (product_price === "") {
    swal('Error','Please Enter product Price ','error');
    document.getElementById("error").innerHTML="Please Enter product Price ";
    return false;
  }
}
</script>  
</body>
</html>