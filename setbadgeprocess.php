<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";
$mysqli = new mysqli("localhost","root","","user");
#every single time this php page is visited the number of questions is deduced by one
#this indicated the number of questions left to be inputted by the user


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}// values are defined here

$name=$_POST['name'];
$qid = $_SESSION['QuizID'];
$sqlbadge = "INSERT INTO `badges`(BadgeName, BadgeQuiz) VALUES ('$name','$qid');";
//inserting the badge

header("location:quiz.php");

?>