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

$src = $_POST['UsernameSearch'];

$sql = "SELECT * FROM `user_details` WHERE `Name` LIKE '$src%'";

$sql2 =  "SELECT * FROM `user_details` WHERE `Name` LIKE '%$src'";
// check for results that contain the keyword
$sql1res = $mysqli->query($sql);
$sql2res = $mysqli->query($sql2);
//if there isa result
if($sql1res -> num_rows < 1){
  if ($sql2res -> num_rows < 1){
    $_SESSION['SearchResQ'] = "No items were found";
  }else{
    $_SESSION['SearchResQ'] = $sql2;
  }
}else{
  $_SESSION['SearchResQ'] = $sql;
}
header("location: socialsearchview.php");
$conn->close();

?>