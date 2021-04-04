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
$sql = "SELECT * FROM purchase WHERE id=:id";
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $_GET['id']));
$row = $query->fetch(PDO::FETCH_ASSOC); 
$idi=($_SERVER["PHP_SELF"]);
$idi.='?id='.$_GET["id"];
$remarks= isset($_POST["remarks"]) ? trim($_POST["remarks"]) : "";
$status="Delivered Successfully";
$sql="UPDATE purchase SET  status=:status WHERE ID=:id";
$result = $pdo->prepare($sql);
$result->bindParam(":status", $status, PDO::PARAM_STR);
$result->bindParam(":id",$_GET["id"], PDO::PARAM_STR);
if($result->execute()){ ?>
<script>
setTimeout(function() {
    swal({
    title: "Success!",
    text: "Delivered Successfully",
    type: "success"
    }, function() {
        window.location = "stockdelivery.php";
    });
    }, 100);
 </script> <?php
}else {  ?>
 <script>
        setTimeout(function() {
               swal({
              title: "ERROR!",
              text: "Oops ! Something Went Wrong",
              type: "error"
              });
            }, 100);
  </script>
<?php
}
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
    <h1>Delivery Stock</h1>
     <table id="myTable" style="width:700px">
    <tr>
        </tr>
        <td>Student Name<td>:<td><?php echo $row['Stu_name'] ?>
    <tr>
    <td>Student Register Number<td>:<td><?php echo $row['stu_regno'] ?>
    </tr>
  <!--  <tr>
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
    <td>Phone Number<td>:<td><?php echo $row['phno'] ?>
    </tr>
    <tr>
    <td>Student Address<td>:<td><?php echo $row['stu_address'] ?>
    </tr>
    <tr>
    <td>Student Email<td>:<td><?php echo $row['email'] ?>   -->
    </tr>
    </table>
    <label>Enter Remarks</label>
    <textarea style="width:400px" class="form-control" name="remarks" id="remark"></textarea>
    <button style='background-color:#cc0044;margin-top:20px;' class='btn btn-primary' >Dispatched</button>    

    <div style="margin-top:70px">
    <?php include_once("Footer.php") ?>
    </div>