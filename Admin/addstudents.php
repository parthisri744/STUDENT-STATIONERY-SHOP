<?php
require_once "config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
} 
//$database=new PDO("mysql:host=localhost;dbname=SSS","root","");
        $sql = "SELECT * FROM students WHERE id=:id";
        $query = $pdo->prepare($sql);
        $query->execute(array(':id' => $_GET['id']));
        $row = $query->fetch(PDO::FETCH_ASSOC);       
class useradd {
    private $err;
    public function get_data_from_post($param){
        return isset($_POST[$param]) ? trim($_POST[$param]) : "";              
    }
    public function check_empty_errors($error){
        if(empty($error)){
            return true;
        }else {
            return false;
        }
    }  
    public function update_data($regno,$sname,$dob,$balance,$phno,$stu_address,$email,$password) {
        $database=new PDO("mysql:host=localhost;dbname=SSS","root","");
        $sql="UPDATE students SET regno=:regno,sname=:sname,dob=:dob,balance=:balance,phno =:phno,stu_address=:stu_address,email=:email,password=:password WHERE ID=:id ";
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
         $stmt->bindParam(":sname", $sname, PDO::PARAM_STR);
         $stmt->bindParam(":dob", $dob , PDO::PARAM_STR);
         $stmt->bindParam(":balance", $balance , PDO::PARAM_STR);
         $stmt->bindParam(":phno", $phno, PDO::PARAM_STR);
         $stmt->bindParam(":stu_address", $stu_address, PDO::PARAM_STR);
         $stmt->bindParam(":email", $email , PDO::PARAM_STR);
         $newpassword=password_hash($password, PASSWORD_DEFAULT);
         $stmt->bindParam(":password", $newpassword , PDO::PARAM_STR);
         $stmt->bindParam(":id",$_GET["id"], PDO::PARAM_STR);
        try{           
            $stmt->execute();
            return true;
        } catch (PDOException $e){
             echo "sql = ".$sql."<br/>".$e->getMessage();
            return 0;
        }
    }  
    public function get_errors(){
       return  $this->err;
       
    }    
}
$error = "";
$idi=($_SERVER["PHP_SELF"]);
$idi.='?id='.$_GET["id"];
$obj=new useradd();
$regno= $obj->get_data_from_post("regno");
$sname= $obj->get_data_from_post("sname");
$dob= $obj->get_data_from_post("dob");
$balance= $obj->get_data_from_post("balance");
$phno= $obj->get_data_from_post("phno");
$stu_address= $obj->get_data_from_post("stu_address");
$email= $obj->get_data_from_post("email");
$password= $obj->get_data_from_post("password");
if($obj->check_empty_errors($regno)==true){
     $error="";
} else {
        $i= $obj->update_data($regno,$sname,$dob,$balance,$phno,$stu_address,$email,$password);
        if($i==true){
            $succ=" Student Details Updated  Successfully ";
            $url="stu_edit.php?id=".$_GET["id"]; 
        }else {
            $error="Tecnical Issue Occured , Please Contact Developer";
        }
    }    
?>
<style type="text/css">
        body{ font: 14px sans-serif;background-color:lightblue }
        .wrapper{ width: 350px; padding: 10px;text-align:left;}
        .help-block{color:red}
    </style>
<div>
        <?php include_once("Navigation.php")  ?>
        </div>
        <div class="page-header"  align="center">
        <img src="assets/img/student-graduate.jpg" alt="Anna University" width="auto" width="auto">
        <h2>ADD STUDENTS</h2>
        <?php 
         if(strlen($error) > 2) { ?>
         <script>
            setTimeout(function() {
            swal({
            title: "Success!",
            text: "<?php echo $error;?>",
            type: "success"
          }, 
          }, 1000);
            </script>
        <?php 
         } else{ ?>
           <script>
            setTimeout(function() {
            swal({
            title: "Success!",
            text: "<?php  echo $succ ?>",
            type: "success"
          }, function() {
            window.location = "stu_edit.php";
            });
              }, 100);
            </script>
           <?php  }  ?>
        <span style="color:red" id="error"></span><span style="color:red"><?php echo $error ?></span>
        <div class="wrapper">
            <form action="<?php echo $idi ?>" name="myForm" onsubmit="return validateForm()" method="post" id="contact-form">
            <div class="form-group">
                <label>Enter Register Number</label>
                <input type="number" name="regno" autocomplete="off" class="form-control" value="<?php echo $row['regno'] ?>" autofocus>
                
            </div>    
            <div class="form-group">
                <label>Enter Student Name</label>
                <input type="text" name="sname"  value="<?php echo $row['sname'] ?>" class="form-control">
                
            </div>
            <div class="form-group">
                <label>Enter  Date Of Birth</label>
                <input type="date" name="dob" value="<?php echo $row['dob'] ?>" class="form-control">
               
            </div>
            <div class="form-group">
                <label>Enter Student Account Balance</label>
                <input type="text" name="balance" placeholder="Enter Balance" value="<?php echo $row['balance'] ?>"  class="form-control">
                
            </div>
            <div class="form-group">
                <label>Enter Phone Number :</label>
                <input type="number" name="phno" value="<?php echo $row['phno'] ?>" class="form-control">
            </div>
           <div class="form-group">
                <label>Enter Address :</label>
              <input style="height:80px" type="text" name="stu_address" value="<?php echo $row['stu_address'] ?>" class="form-control">
            </div>   
            <div class="form-group">
                <label>Enter Email ID</label>
                <input type="email" name="email" value="<?php echo $row['email'] ?>" class="form-control">
            </div>
            <div class="form-group">
                <label>Enter Password</label>
                <input type="password" name="password" value="<?php echo $row['[password'] ?>" class="form-control">
            </div>
            
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="update"><a class="btn" style="background-color:red;" href="stu_edit.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
<div>
    <?php include_once("Footer.php") ?>
</div>
<script>
function validateForm() {
  var regno = document.forms["myForm"]["regno"].value;
  if (regno == "") {
    swal('Error','Please Enter Register No','error');
    document.getElementById("error").innerHTML="Please Enter Register No ";
    return false;
  }
  var sname = document.forms["myForm"]["sname"].value;
  if (sname == "") {
    swal('Error','Please Enter Student Name','error');
    document.getElementById("error").innerHTML="Please Enter Student Name ";
    return false;
  }
  var dob = document.forms["myForm"]["dob"].value;
  if (dob == "0") {
    swal('Error','Please Enter Date Of Birth','error');
    document.getElementById("error").innerHTML="Please Enter Date Of Birth ";
    return false;
  }
  var balance = document.forms["newForm"]["balance"].value;
  if (balance == "") {
    swal('Error','Please Enter Balance','error');
    document.getElementById("error").innerHTML="Please Enter Balance";
    return false;
  }
  if (phno == "") {
    swal('Error','Please Enter Phone Number ','error');
    document.getElementById("error").innerHTML="Please Enter Phone Number";
    return false;
  } 
  var stu_address = document.forms["newForm"]["stu_address"].value;
  if (stu_address == "") {
    swal('Error','Please Enter Address ','error');
    document.getElementById("error").innerHTML="Please Enter Password";
    return false;
  }
  var email = document.forms["newForm"]["email"].value;
  if (email == "") {
    swal('Error','Please Enter Email','error');
    document.getElementById("error").innerHTML="Please Enter Email";
    return false;
  }  
}
</script>