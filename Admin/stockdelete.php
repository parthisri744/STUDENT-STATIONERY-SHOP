<?php
//including the database connection file
include("config.php");
$id = $_GET['id'];
$sql = "SELECT * FROM adminstock WHERE id=:id";
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $_GET['id']));
$row = $query->fetch(PDO::FETCH_ASSOC); 
$column_name = $row['product_name'];
$newsql="ALTER TABLE purchase DROP $column_name";
echo $newsql;
$st = $pdo->prepare($newsql);
if($st->execute()){
$sql = "DELETE FROM adminstock WHERE id=:id";
$query = $pdo->prepare($sql);
$query->execute(array(':id' => $id));
header("Location:stockview.php"); 
}
?>