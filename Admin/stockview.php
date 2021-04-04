<?php
include_once("config.php");
 require_once "config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
   //exit;
}  

$result = $pdo->query("SELECT * FROM adminstock ");
include("Navigation.php")
?>
<link rel="stylesheet" href="search.css">
<div align="center">
    <h1 >Stock Availability </h1>
    <table id='myTable' style="width:500px">
 
    <tr bgcolor='#CCCCCC'><th>Product Name</th><th scope='col'>Product Quantity</th><th>Product Price</th><th>Update</th><th>Delete</th></tr>
    <?php     
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
        echo "<tr>";
        echo "<td>".$row['product_name']."</td>";
        echo "<td>".$row['product_quantity']."</td>";
        echo "<td>".$row['product_price']."</td>";    
        $furl= "stockdelete.php?id=".$row['ID'];
        echo "<td><button class='btn btn-primary'  style='background-color:#00cc44'><a style='color:white' href=\"stockedit.php?id=$row[ID]\">Update</a></button> </td>";
        echo "<td><button style='background-color:#cc0044' class='btn btn-primary' onClick='myfun()'>Delete</button> </td>";    
    
    }
    ?>
    </div>
    </table>
    <br/>
    <div>
 <?php include_once("Footer.php") ?>
</div>
<script>
function myfun(){
setTimeout(function() {
swal({
  title: "Are you sure?",
  text: "You will not be able to recover this student details!",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, delete it!",
  cancelButtonText: "No, cancel !",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm) {
  if (isConfirm) { 
    window.location = "<?php echo  $furl; ?>";
    swal("Deleted!", "Stock Details Successfully !.", "success");
  } else {
    swal("Cancelled", "Your Data is Safe :)", "error");
  }
});
} ,100);
}
</script>