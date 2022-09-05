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

$qid = $_POST["questionid"];

$_SESSION["QuestionID"] = $qid;
//setting the session variable and redirecting
header("location: questionview.php");

$conn->close();

?>