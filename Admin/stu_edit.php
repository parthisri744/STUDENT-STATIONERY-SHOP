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

$result = $pdo->query("SELECT * FROM students ORDER BY ID DESC");
include("Navigation.php")
?>
<link rel="stylesheet" href="search.css">
<div align="center">
    <h1 >Edit Student Data</h1>
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Register Number.." autocomplete="off" title="Type in a name"> 
</div>
    <table id='myTable'>
 
    <tr bgcolor='#CCCCCC'><th>Register Number</th><th scope='col'>Name</th><th>Date Of Birth</th>
<th>Course</th><th>Branch</th><th>Year</th><th>Phone No</th><th>Email</th><th>Edit</th></tr>
    <?php     
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {         
        echo "<tr>";
        echo "<td>".$row['regno']."</td>";
        echo "<td>".$row['sname']."</td>";
        echo "<td>".$row['dob']."</td>";    
        echo "<td>".$row['course']."</td>"; 
        echo "<td>".$row['branch']."</td>"; 
        echo "<td>".$row['syear']."</td>"; 
        echo "<td>".$row['phno']."</td>"; 
        echo "<td>".$row['email']."</td>"; 
        echo "<td><button class='btn btn-primary'><a style='color:white' href=\"addstudents.php?id=$row[ID]\">Edit</a></button> </td>";    
    }
    ?>
    </table>
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
</script>