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

$uid = $_SESSION["userid"];

$question=$_POST['question'];
$answer=$_POST['answer'];
$_SESSION['questions'] = $_SESSION['questions'] - 1;
$QuizID = $_SESSION["QuizID"];

$sql="INSERT INTO `questions`(`quizID`, `question`, `answer`) VALUES ($QuizID,'$question','$answer');";

if ($conn->query($sql) === TRUE){
  if ($_SESSION['questions'] > -1){
    header('location:setquestions.php');
    // if there arent any questions to be set the user will be redirected
  }else{

    $sqlspoint = "SELECT * FROM `points` WHERE `UserID` = '$uid'";
    $resspoint = $mysqli->query($sqlspoint);
    $rowspoint = mysqli_fetch_assoc($resspoint);

    $sbalance = $rowspoint["SPoints"];
    //retrieving the spoint balance of the user
    $award = $_SESSION['award'];
    $award = $award / 100;
    $newsbalance = $sbalance + $award;

    $sqlpoint2 = "UPDATE `points` SET `SPoints` = '$newsbalance' WHERE `UserID` = '$uid'";
    $sqlpointrun2 = $mysqli->query($sqlpoint2);
    //updating the spoint balance of the user
    $badge = $_SESSION["badge"];
    unset($_SESSION['questions']);
    
    $rank = $_SESSION['rank'];
    if (intval($rank) > 4){
      header("location:setbadge.php");
      // if the rank of the user is capable of setting badges then the user will be redirected ot the badge page
    }else{
    header('location:quizes.php');
    }
  }
}else{
  echo" Error";
}

?>