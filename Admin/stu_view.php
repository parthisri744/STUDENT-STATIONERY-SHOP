<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
   //exit;
}  ?>
<link rel="stylesheet" href="search.css">
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
<?php
include_once("Navigation.php");
?>
<div align="center">
<h1 >Student Data Table</h1>
<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Register Number.." title="Type in a name"> 
</div>
<?php
echo "<div class='table-responsive'>";
echo "<table id='myTable'>";
echo "<tr class='header' ><th>Register Number</th><th scope='col'>Name</th><th>Date Of Birth</th>
<th>Course</th><th>Branch</th><th>Year</th><th>Phone No</th><th>Email</th></tr>";
class TableRows extends RecursiveIteratorIterator {
  function __construct($it) {
    parent::__construct($it, self::LEAVES_ONLY);
  }

  function current() {
    return "<td>" . parent::current(). "</td>";
  }

  function beginChildren() {
    echo "<tr>";
  }

  function endChildren() {
    echo "</tr>" . "\n";
  }
}
try {
  $conn = new PDO("mysql:host=localhost;dbname=SSS","root", "");
  $count=1;
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT regno,sname,dob,course,branch,syear,phno,email  FROM  students");
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
    echo $v;
  }
  $count++;
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
//include_once("Footer.php") 
?>