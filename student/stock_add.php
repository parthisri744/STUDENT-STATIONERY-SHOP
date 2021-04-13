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
//students Table Data
/*
$sql = "SELECT * FROM students WHERE id=:id";
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $_SESSION["id"]));
$row = $query->fetch(PDO::FETCH_ASSOC); */
$result = $pdo->query("SELECT * FROM adminstock ");
//$result->execute(array(':id' => $_SESSION["id"]));
$result->execute();
$srow = $result->fetch(PDO::FETCH_ASSOC); 
//insert Part
$idi=($_SERVER["PHP_SELF"]);
$idi.='?id='.$_GET["id"];
$pname=isset($_POST["pname"]) ? trim($_POST["pname"]) : "";
$quantity= isset($_POST["quantity"]) ? trim($_POST["quantity"]) : "";
//echo "Product Name :".$pname;
//echo "Product Quantity".$quantity;
$usql="UPDATE purchase SET  $pname=:quantity  WHERE ID=:id ";;
$stmt=$pdo->prepare($usql);
$stmt->bindParam(":quantity", $quantity, PDO::PARAM_STR);
$stmt->bindParam(":id",$_GET["id"], PDO::PARAM_STR);
if( $pname!="" && $quantity!="" ){
  try{           
    $stmt->execute();
    $old_quant=$srow['product_quantity'];
    $product_quantity=$old_quant-$quantity;
    $bsql="UPDATE adminstock SET product_quantity=:product_quantity WHERE product_name=:product_name ";;
    $stm=$pdo->prepare($bsql);
    $stm->bindParam(":product_quantity", $product_quantity ,PDO::PARAM_STR);
    $stm->bindParam(":product_name", $pname, PDO::PARAM_STR);
    try{           
       $stm->execute();
  } catch (PDOException $e){
    echo "sql = ".$bsql."<br/>".$e->getMessage();
    return false;
   }
    ?>
                 <script>
            setTimeout(function() {
               swal({
              title: "Success!",
              text: "Product Added Sucessfully !!",
              type: "success"
              }, function() {
                window.location = "<?php echo  $idi; ?>";
               });
            }, 100);
            </script>
    <?php
  } catch (PDOException $e){
    echo "sql = ".$sql."<br/>".$e->getMessage();
    return false;
   }
  }
   /*     $price_result = $pdo->prepare("SELECT * FROM adminstock WHERE product_name=:product_name");
        $price_result->bindParam(":product_quantity", $pname ,PDO::PARAM_STR);
        $price_result->execute();
        $price_row = $price_result->fetch(PDO::FETCH_ASSOC);
        $pric= $price_row['product_price'];
        $old_balace=$_SESSION["balance"];
        $balance=$old_balace-($pric*$quantity);
        $ssql="UPDATE students SET balance=:balance WHERE regno=:regno ";;
        $st=$pdo->prepare($ssql);
        $st->bindParam(":balance", $balance ,PDO::PARAM_STR);
        $st->bindParam(":regno", $_SESSION["username"], PDO::PARAM_STR);
        try{           
        $st->execute();
          
        } catch (PDOException $e){
             echo "sql = ".$ssql."<br/>".$e->getMessage();
         return false;
  } 

/*$old_balace=$_SESSION["balance"];
  $pro_price=$srow['product_price'];
  $new_price=$pro_price*$quantity; 

  $price_result->bindParam(":product_quantity", $pname ,PDO::PARAM_STR);
  $price_result->execute();
  $price_row = $price_result->fetch(PDO::FETCH_ASSOC);  
  echo  $price_row['product_price'];
 /*  
  $ssql="UPDATE students SET balance=:balance WHERE regno=:regno ";;
  $st=$pdo->prepare($ssql);
  $st->bindParam(":balance", $balance ,PDO::PARAM_STR);
  $st->bindParam(":regno", $_SESSION["username"], PDO::PARAM_STR);
  try{           
       $st->execute();
          
     } catch (PDOException $e){
       echo "sql = ".$ssql."<br/>".$e->getMessage();
       return false;
  } */
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
        <img src="Images/buy.png" alt="Anna University" width="10%" width="10%">
        <h2>Purchase Products</h2>
        <h4 style="color:red">Available Balance:<?php echo $_SESSION["balance"]    ?> </h4>
        <div class="wrapper">
        <form action="<?php echo $idi ?>" name="myForm" onsubmit="return validateForm()" method="post" id="contact-form">
        <div class="form-group">
                    <select selected class="form-control" name="pname">
                        <option value="Please select">Please select </option>
                        <?php while($srow = $result->fetch(PDO::FETCH_ASSOC)) {  ?>
                          <option value="<?php echo $srow['product_name'];?>" ><?php echo $srow['product_name']; ?></option> 
                        <?php } ?>
                    </select>
                </div> 
            <div class="form-group">
                <label>Enter the number of Quantity</label>
                <input type="text" name="quantity" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="Add Product"> <a class="btn" style="background-color:red;" onclick="return success_msg()"  href="#">Finish</a>
            </div>
        </form>
    </div>
    <script>
function validateForm() {
  var pname = document.forms["myForm"]["pname"].value;
  if (pname =="") {
    swal('Error','Please Select the Product Name','error');
    return false;
  }
  var quantity = document.forms["myForm"]["quantity"].value;
  if (quantity == "") {
    swal('Error','Please Enter Number of Quantity','error');
    return false;
  }
}
function success_msg(){
           setTimeout(function() {
               swal({
              title: "Success!",
              text: "Thank You For Purchasing !!",
              type: "success"
              }, function() {
                window.location = "<?php echo "welcome.php" ?>";
               });
            }, 100);
}
</script>
<div>
    <?php include_once("Footer.php") ?>
</div>
