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

$title=$_POST['title'];
$question=$_POST['question'];
$award=$_POST['award'];
$UserID=$_SESSION["userid"];
//variables retrieved from posted form
$sqlpoint="SELECT * FROM `points` WHERE `UserID`= $UserID";
$sqlpointres = $mysqli->query($sqlpoint);
$rowsqlpoint = mysqli_fetch_assoc($sqlpointres);

$pointu = $rowsqlpoint["Points"];
// retrieved the points with previously retrieved data
//serverside validation of user having enough points to ask this question
if($pointu < $award){
  $_SESSION['Pointerror'] = "Insufficient points";
  header("location:questions_home.php");
}else{
if ($award >= 100){
$_SESSION['Pointerror'] = "";
$sql="insert into singularquestions (title,question,CreatorID,award)
values('$title','$question','$UserID','$award')";
$sqlres = $mysqli->query($sql);
header('location:homeli.php');
}else{
  header('location:questions_home.php');
}
}
?>