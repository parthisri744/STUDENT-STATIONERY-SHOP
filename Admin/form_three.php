<?php
//require_once "config.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
   //exit;
}  
class useradd {
    private $err;
    public $id; 
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
    public function insert($phno,$stu_address,$email,$password,$id) {
       $database=new PDO("mysql:host=localhost;dbname=SSS","root","");
       // $sql="UPDATE students SET phno =:phno,stu_address=:stu_address,email=:email WHERE ID=:id ";;
      $sql="UPDATE students SET phno =:phno,stu_address=:stu_address,email=:email,password=:password WHERE ID=:id ";
      // $sql="UPDATE students SET phno =$phno,stu_address=$stu_address,email=$email,password=$password WHERE ID=$id ";
      // echo $sql;
         $newpassword=password_hash($password, PASSWORD_DEFAULT);
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":phno", $phno, PDO::PARAM_STR);
         $stmt->bindParam(":stu_address", $stu_address, PDO::PARAM_STR);
         $stmt->bindParam(":email", $email , PDO::PARAM_STR);
         $stmt->bindParam(":password", $newpassword , PDO::PARAM_STR);
         $stmt->bindParam(":id",$_GET["id"], PDO::PARAM_STR);
         //echo $_GET["id"];
        try{           
            $stmt->execute();
            return true;
            echo "sql = ".$sql."<br/>".$e->getMessage();
        } catch (PDOException $e){
            return 0;
        }
    }      
    public function get_errors(){
       return  $this->err;
    }    
}
$error = "";
//echo ($_SERVER["PHP_SELF"]).?id=$_GET["id"];
$idi=($_SERVER["PHP_SELF"]);
$idi.='?id='.$_GET["id"];
//echo $idi;
//$curl="stu_view.php?id=".$_GET["id"];
$obj=new useradd();
$phno= $obj->get_data_from_post("phno");
$stu_address= $obj->get_data_from_post("stu_address");
$email= $obj->get_data_from_post("email");
$password= $obj->get_data_from_post("password");
if(($obj->check_empty_errors($phno) && $obj->check_empty_errors($stu_address) && $obj->check_empty_errors($email) && $obj->check_empty_errors($password))==true) {
     $error="";
} else {
    if($obj->check_empty_errors($phno)==false){
        $i= $obj->insert($phno,$stu_address,$email,$password,$_GET["id"]);
        if($i==true){
            $succ="Submitted Successfully ";
            $furl="stu_view.php?id=".$_GET["id"]; 
        }else {
            $error="Tecnical Issue Occured , Please Contact Developer";
            
        }
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
        <div class="page-header"  align="center">
        <img src="assets/img/student-graduate.jpg" alt="Anna University" width="auto" width="auto">
        <h2>ADD STUDENTS</h2>
        <?php 
         if(strlen($error) > 2) { ?>
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
            } else{ ?>
            <script>
            setTimeout(function() {
               swal({
              title: "Success!",
              text: "Submitted Successfully",
              type: "success"
              }, function() {
                window.location = "<?php echo  $furl; ?>";
               });
            }, 100);
            </script>
           <?php  }  ?>
           <span style="color:red" id="error"></span><span style="color:red"><?php echo $error ?></span>
        <div class="wrapper">
        <form action="<?php echo  $idi; ?>" name="newForm" onsubmit="return validateForm()" method="post" id="contact-form">
        <div class="form-group">
                <label>Enter Phone Number :</label>
                <input type="number" name="phno" class="form-control">
            </div>
           <div class="form-group">
                <label>Enter Address :</label>
              <textarea  name="stu_address" class="form-control"></textarea> 
            </div>   
            <div class="form-group">
                <label>Enter Email ID</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Enter Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="Finish">  <a class="btn" style="background-color:red;" href="<?php echo $curl ?>">Cancel</a>
            </div>
        </form>
    </div>
</div>
<div>
    <?php include_once("Footer.php") ?>
</div>
<script>
function validateForm() {
  var phno = document.forms["newForm"]["phno"].value;
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
  var password = document.forms["newForm"]["password"].value;
  if (password == "") {
    swal('Error','Please Enter Password','error');
    document.getElementById("error").innerHTML="Please Enter Password";
    return false;
  }
};
</script>