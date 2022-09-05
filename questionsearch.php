<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";
$mysqli = new mysqli("localhost","root","","user");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$src = $_POST['Search'];

$sql = "SELECT * FROM `singularquestions` WHERE `Title` LIKE '$src%'";

$sql2 =  "SELECT * FROM `singularquestions` WHERE `Title` LIKE '%$src'";
// running individual sql queries for the keyword, first with things that start with it and then things that might contain it
$sql1res = $mysqli->query($sql);
$sql2res = $mysqli->query($sql2);

if($sql1res -> num_rows < 1){
  if ($sql2res -> num_rows < 1){
    $_SESSION['SearchRes'] = "No items were found";
  }else{
    $_SESSION['SearchRes'] = $sql2;
  }
}else{
  $_SESSION['SearchRes'] = $sql;
}
header("location: questionsearchview.php");
$conn->close();

?>