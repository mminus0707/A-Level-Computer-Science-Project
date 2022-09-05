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

$iid = $_POST["itemid"];
//retrieving the user id
$sqlitem = "SELECT * FROM `items` WHERE `ItemID` = $iid";
$sqliidres = $mysqli->query($sqlitem);
$row = mysqli_fetch_assoc($sqliidres);
$price = $row['Price'];
$sprice = $row['SPrice'];

$uid = $_SESSION['userid'];

$sqlpoint = "SELECT * FROM `points` WHERE `UserID` = $uid";
$sqlpointres = $mysqli->query($sqlpoint);
$row2 = mysqli_fetch_assoc($sqlpointres);
$balance = $row2['Points'];
$sbalance = $row2['SPoints'];
//retrieving the user balance
//checking if the user has enough funds
if (($balance >= $price) && ($sbalance >= $sprice)){
  $newbalance = $balance - $price;
  $newsbalance = $sbalance - $sprice;
  //updatin the user spoint
  $sqlpoint2 = "UPDATE `points` SET `SPoints` = '$newsbalance' WHERE `UserID` = '$uid'";
  $sqlpointrun2 = $mysqli->query($sqlpoint2);
  //updating the points
  $sqlpoint1 = "UPDATE `points` SET `Points` = '$newbalance' WHERE `UserID` = '$uid'";
  $sqlpointrun1 = $mysqli->query($sqlpoint1);
  //adding the item to their inventory
  $sqlinventory="insert into inventory (UserID,ItemID) values('$uid','$iid')";
  $sqlinv = $mysqli->query($sqlinventory);

  header("location: shop.php");
}else{
  header("location: shop.php");
}

$conn->close();

?>