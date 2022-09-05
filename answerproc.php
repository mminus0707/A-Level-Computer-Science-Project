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
}// values are defined here
$answer=$_POST['answer_container'];
$questionid=$_SESSION['QuestionID'];
$username=$_SESSION['name'];
// retrieved the answer and question it belongs to alongside the person who posted it
$sqluid="select * from `user_details` where `Name` = '$username'";
// query for userid to be retrieved
$resuid=$mysqli->query($sqluid);
$rowuid = mysqli_fetch_assoc($resuid);
$uid=$rowuid['UserID'];
//userid retrieved

//sql for inserting
$sql = "INSERT INTO questionanswers (QuestionID,UserID,AnswerText) VALUES ('$questionid','$uid','$answer')";
//validation of query taking place
if ($conn->query($sql) === TRUE){
    header('location:questions_home.php');
    }
$conn->close();
?>