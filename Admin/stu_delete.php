<?php
//including the database connection file
include_once("config.php");
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
function decrypt($ivHashCiphertext, $password) {
  $method = "AES-256-CBC";
  $iv = substr($ivHashCiphertext, 0, 16);
  $hash = substr($ivHashCiphertext, 16, 32);
  $ciphertext = substr($ivHashCiphertext, 48);
  $key = hash('sha256', $password, true);
  //echo "Inside Function".$ivHashCiphertext."Key :".$password;

  if (!hash_equals(hash_hmac('sha256', $ciphertext . $iv, $key, true), $hash)) return null;
  //echo " jhjkhj".openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
  return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
} 
$result = $pdo->query("SELECT * FROM students ORDER BY ID DESC");
include("Navigation.php")
?>
<link rel="stylesheet" href="search.css">
<div align="center">
    <h1 >Delete Student Data</h1>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Register Number.." autocomplete="off" title="Type in a name"> 
</div>
    <table id='myTable'>
 
    <tr bgcolor='#CCCCCC'><th>Register Number</th><th scope='col'>Name</th><th>Date Of Birth</th>
<th>Course</th><th>Branch</th><th>Year</th><th>Phone No</th><th>Email</th><th>Delete</th></tr>
    <?php    
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
      echo "<tr>";
      echo "<td>".$row['regno']."</td>";
      echo "<td>".decrypt(base64_decode(($row['sname'])),'ucensss')."</td>";      
      echo "<td>".$row['dob']."</td>";    
      echo "<td>".$row['course']."</td>"; 
      echo "<td>".$row['branch']."</td>"; 
      echo "<td>".$row['syear']."</td>"; 
      echo "<td>".decrypt(base64_decode(($row['phno'])),'ucensss')."</td>"; 
      echo "<td>".decrypt(base64_decode(($row['email'])),'ucensss')."</td>"; 
        //echo "<td><button class='btn btn-primary' onClick='myfun()'  style='background-color:red' > Delete</button></td>";  
        echo "<td><button class='btn btn-primary' onClick='myfun()'  style='background-color:red' > Delete</button></td>";   
    }

    ?>
    </table>
    <style>
    body {
  font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
}
    </style>
    <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
  td = tr[i].getElementsByTagName("td")[0];
  if (td) {
  txtValue = td.textContent || td.innerText;
  if (txtValue.toUpperCase().indexOf(filter) > -1) {
  tr[i].style.display = "";
  } else {
  tr[i].style.display = "none";
  }
  }       
  }
}  
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
    swal("Deleted!", "Student Data Deleted Successfully !.", "success");
  } else {
    swal("Cancelled", "Student Data is Safe :)", "error");
  }
});
} ,100);
}
</script>