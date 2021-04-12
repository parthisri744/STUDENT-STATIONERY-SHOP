<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
$regno=isset($_POST["regno"]) ? trim($_POST["regno"]) : "";
$sname = isset($_POST["sname"]) ? trim($_POST["sname"]) : "";
$dob= isset($_POST["dob"]) ? trim($_POST["dob"]) : "";
$sql="INSERT INTO purchase (Stu_name,stu_regno,status) VALUES (:Stu_name,:stu_regno,:status)";
$result = $pdo->prepare($sql);
$result->bindParam(":Stu_name", $_SESSION["sname"] , PDO::PARAM_STR);
$result->bindParam(":stu_regno", $_SESSION["username"], PDO::PARAM_STR);
$status="Waiting For Delivery";
$result->bindParam(":status", $status , PDO::PARAM_STR);
if( $_SESSION["sname"]!="" &&$_SESSION["username"]!="" && $status!=""){
if($result->execute()) {
  $lastin_id=$pdo->lastInsertId();
  $url="stock_add.php?id=".$lastin_id;
  ?>
   <script>
            setTimeout(function() {
               swal({
              title: "Success!",
              text: "Submitted Successfully",
              type: "success"
              }, function() {
               window.location = "<?php echo  $url; ?>";
               });
            }, 10000);
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
  </script> <?php
}
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
    <h1>Student Details</h1>
    <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" name="myForm"  method="post">
     <table id="myTable" style="width:700px">
    <tr>
    <td>Student Name<td>:<td><?php echo $_SESSION["sname"]    ?>
    </tr>
    <tr>
    <td>Student Register Number<td>:<td><?php echo $_SESSION["username"]  ?>
    </tr>
    <tr>
    <td>Student Account Balance<td>:<td><?php echo $_SESSION["balance"]  ?>
    </tr>
    <tr>
    </tr>
    </table><br/>
    <h4 style="color:blue">Note : After Few Seconds This page will be Automatically Redirect To purchase Section</h4>
    <div class="form-group">
     <input type="submit" style="background-color:green;" class="btn" value="Confirm & Buy Product"> <a class="btn" style="background-color:red;" href="welcome.php">Cancel</a>
     </form>
    </div>
    <div>
    <?php include_once("Footer.php") ?>
    </div>

