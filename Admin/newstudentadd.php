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
    public function insert($regno,$sname,$dob) {
       $database=new PDO("mysql:host=localhost;dbname=SSS","root","");
        $sql="INSERT INTO students (regno,sname,dob) VALUES (:regno,:sname,:dob)";
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
         $stmt->bindParam(":sname", $sname, PDO::PARAM_STR);
            $stmt->bindParam(":dob", $dob , PDO::PARAM_STR);
        try{           
            $stmt->execute();
            return $database->lastInsertId();
        } catch (PDOException $e){
             echo "sql = ".$sql."<br/>".$e->getMessage();
            return 0;
        }
    }
    public function valid_data($regno){
    //  echo "Regno".$regno;
        $database=new PDO("mysql:host=localhost;dbname=SSS","root","");
        $sql = "SELECT ID FROM students WHERE regno = :regno";
        $stmt = $database->prepare($sql);
        $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
        try{           
            $stmt->execute();
            if($stmt->rowCount() == 1){
              return true;
            }else{
             return  false;
            }
        } catch (PDOException $e){
             echo "sql = ".$sql."<br/>".$e->getMessage();
            // frame_session_log("SQL",$e->getMessage());
            return 0;
        }
}       
    public function get_errors(){
       return  $this->err;
       
    }    
}
$error = "";
$obj=new useradd();
$regno= $obj->get_data_from_post("regno");
$sname= $obj->get_data_from_post("sname");
$dob= $obj->get_data_from_post("dob");
if($obj->check_empty_errors($regno)==true){
     $error="";
} else {
    if($obj->valid_data($regno) ==true){
        $error="Register Number Is Already Exist";
    }else{
        $i= $obj->insert($regno,$sname,$dob);
        if($i==0) {
            $error="Oops ! Something Went Wrong";
        }else {
            $url="newstudentaddrule.php?id=".$i; 
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
        </div>
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
                window.location = "<?php echo  $url; ?>";
               });
            }, 100);
            </script>
           <?php  }  ?>
        <span style="color:red" id="error"></span><span style="color:red"><?php echo $error ?></span>
        <div class="wrapper">
            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" name="myForm" onsubmit="return validateForm()" method="post" id="contact-form">
            <div class="form-group">
                <label>Enter Register Number</label>
                <input type="number" name="regno" class="form-control" autofocus>
                
            </div>    
            <div class="form-group">
                <label>Enter Student Name</label>
                <input type="text" name="sname" autocomplete="off"  class="form-control">
                
            </div>
            <div class="form-group">
                <label>Enter  Date Of Birth</label>
                <input type="date" name="dob" class="form-control">
               
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
function    validateForm() {
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
  if (dob == "") {
    swal('Error','Please Enter Date Of Birth','error');
    document.getElementById("error").innerHTML="Please Enter Date Of Birth ";
    return false;
  }
}
</script>