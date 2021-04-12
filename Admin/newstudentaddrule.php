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
    public function insert($course,$branch,$syear,$balance,$id) {
       $database=new PDO("mysql:host=localhost;dbname=SSS","root","");
        $sql="UPDATE students SET course =:course,branch=:branch,syear=:syear,balance=:balance WHERE ID=:id ";;
     //  $sql="UPDATE students SET course =$course,branch=$branch,syear=$syear WHERE ID=$id ";
         $stmt=$database->prepare($sql); 
         $stmt->bindParam(":course", $course, PDO::PARAM_STR);
         $stmt->bindParam(":branch", $branch, PDO::PARAM_STR);
         $stmt->bindParam(":syear", $syear , PDO::PARAM_STR);
         $stmt->bindParam(":balance", $balance , PDO::PARAM_STR);
         $stmt->bindParam(":id",$_GET["id"], PDO::PARAM_STR);
         //echo $_GET["id"];
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
//echo ($_SERVER["PHP_SELF"]).?id=$_GET["id"];
$idi=($_SERVER["PHP_SELF"]);
$idi.='?id='.$_GET["id"];
//echo $idi;
$obj=new useradd();
$course= $obj->get_data_from_post("course");
$branch= $obj->get_data_from_post("branch");
$syear= $obj->get_data_from_post("syear");
$balance= $obj->get_data_from_post("balance");
if(($obj->check_empty_errors($course) && $obj->check_empty_errors($branch) && $obj->check_empty_errors($syear) && $obj->check_empty_errors($balance) ) ==true){
     $error="";
} else {
    if($obj->check_empty_errors($course)==false){
        $i= $obj->insert($course,$branch,$syear,$balance,$_GET["id"]);
        if($i==true){
            $url="form_three.php?id=".$_GET["id"]; 
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
                window.location = "<?php echo  $url; ?>";
               });
            }, 100);
            </script>
           <?php  }  ?>
           <span style="color:red" id="error"></span><span style="color:red"><?php echo $error ?></span>
        <div class="wrapper">
            <form action="<?php echo  $idi; ?>" name="newForm" onsubmit="return validateForm()" method="post" id="contact-form">
            <div class="form-group">
                <label>Select Course</label>
                <select name="course" id="course" class="form-control">
                         <option value="0">Please Select </option>
                         <option value="Bachelor of Engineering(BE)">Bachelor of Engineering(BE)</option>
                         <option value="Bachelor of Technology(B.Tech)">Bachelor of Technology(B.Tech)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Select Branch</label>
                <select name="branch" id="branch" class="form-control">
                         <option value="0">Please Select </option>
                         <option value="Computer Science Engineering(CSE)">Computer Science Engineering(CSE)</option>
                         <option value="Information Technology(IT)">Information Technology(IT)</option>
                         <option value="Mechanical Engineering(ME)">Mechanical Engineering(ME)</option>
                         <option value="Electrical and Electronics Engineering(EEE)">Electrical and Electronics Engineering(EEE)</option>
                         <option value="Electronics and Communications Engineering (ECE)">Electronics and Communications Engineering (ECE)</option>
                         <option value="Civil Engineering(CE)">Civil Engineering(CE)</option>
                </select>
            </div>
            <div class="form-group">
                <label>Select Year</label>
                <select name="syear" id="syear" class="form-control">
                         <option value="0">Please Select </option>
                         <option value="First Year">First Year</option>
                         <option value="Second Year">Second Year</option>
                         <option value="Third Year">Third Year</option>
                         <option value="Fourth Year">Fourth Year</option>
                </select>
            </div>
            <div class="form-group">
                <label>Enter Student Account Balance</label>
                <input type="text" name="balance" placeholder="Enter Balance" autocomplete="off"  class="form-control">
                
            </div>
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="Save & Next"><a class="btn" style="background-color:red;" href="newstudentadd.php">Cancel</a>
            </div>
            </div>    
        </form>
    </div>
</div>
<div>
    <?php include_once("Footer.php") ?>
</div>
<script>
function validateForm() {
  var course = document.forms["newForm"]["course"].value;
  if (course == "0") {
    swal('Error','Please Select Course ','error');
    document.getElementById("error").innerHTML="Please Select Course";
    return false;
  } 
  var branch = document.forms["newForm"]["branch"].value;
  if (branch == "0") {
    swal('Error','Please Select  Branch ','error');
    document.getElementById("error").innerHTML="Please Select Brach";
    return false;
  }
  var syear = document.forms["newForm"]["syear"].value;
  if (syear == "0") {
    swal('Error','Please Select Year','error');
    document.getElementById("error").innerHTML="Please Select Year";
    return false;
  }
  var balance = document.forms["newForm"]["balance"].value;
  if (balance == "") {
    swal('Error','Please Enter Balance','error');
    document.getElementById("error").innerHTML="Please Enter Balance";
    return false;
  }
};
</script>