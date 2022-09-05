<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

#every single time this php page is visited the number of questions is deduced by one
#this indicated the number of questions left to be inputted by the user


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// variables retrieved from previous page
$title=$_POST['title'];
$spoints=$_POST['spoints'];
$points=$_POST['points'];
// serverside validation
if (($spoints > -1) && ($points > 99) && (strlen($title)<73)){
$sql="INSERT INTO `items`(`Item`, `Price`, `SPrice`) VALUES('$title',$points,$spoints)";
// making sure that the query takes place
if ($conn->query($sql) === TRUE){
header("location:shop.php");
} else{
  header("location:homeli.php");
}
}
?>