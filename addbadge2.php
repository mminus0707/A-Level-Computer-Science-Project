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

// session variables are created imported from previous page
$title=$_POST['title'];
$qid = $_SESSION["QuizID"];

//sql insertion
$sql="INSERT INTO `badges`(`BadgeName`, `BadgeQuiz`) VALUES ('$title','$qid')";
// query taking place
$conn->query($sql);
//if the query takes place redirect the use
if ($conn->query($sql) === TRUE){
header("location:quizes.php");
}
?>