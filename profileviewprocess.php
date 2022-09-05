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

$uid = $_POST["profileid"];

$_SESSION["ProfileID"] = $uid;
// session variables are set and the user is redirected
header("location: profileview.php");

$conn->close();

?>