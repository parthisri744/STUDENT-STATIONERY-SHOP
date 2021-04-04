<?php
//including the database connection file
include("config.php");
$id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id=:id";
    $query = $pdo->prepare($sql);
    $query->execute(array(':id' => $id));
    header("Location:stu_delete.php"); 

?>