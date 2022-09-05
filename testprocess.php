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

$score = $_POST["score"];
$qid = $_SESSION["TestID"];

$sqltestid = "SELECT * FROM `quiz` WHERE `QuizID` = $qid";
$restestid = $mysqli->query($sqltestid);
$row = mysqli_fetch_assoc($restestid);
$max = $row["MaxPoint"];
$numq = $row["NumQuestion"];
$entries = $row["NumEntries"];
$title = $row["Title"];
//retrieve the test details

$achievedscore = $score / $numq;
$achievedpoints = $achievedscore * $max;
//calculate the percentage achieved

$cid = $row['CreatorID'];
$uid = $_SESSION["userid"];
// set the ids of the creator and the user who took the test

$sqluser = "SELECT * FROM `points` WHERE `UserID` = $uid";
$resuser = $mysqli->query($sqluser);
$rowuser = mysqli_fetch_assoc($resuser);
$currentpoints = $rowuser["Points"];
$currentexperience = $rowuser["Experience"];
//retrieve the user details

$newpoint = $currentpoints + $achievedpoints;
$newexp = $currentexperience + $achievedpoints;
//calculate their new point balance and experience

$sqldone = "UPDATE `points` SET `Points`= $newpoint WHERE `UserID`= $uid";
$sqldonerun = $mysqli->query($sqldone);

$sqldone = "UPDATE `points` SET `Experience`= $newexp WHERE `UserID`= $uid";
$sqldonerun = $mysqli->query($sqldone);
// update their balances and experiences
$newentry = $entries - 1;

$sqldone = "UPDATE `quiz` SET `NumEntries`= $newentry WHERE `QuizID`= $qid";
$sqldonerun = $mysqli->query($sqldone);
//decrement the number of tries in the test
if ($newentry == 0){
  $sqldelq = "DELETE FROM `questions` WHERE `QuizID`= $qid";
  $sqldel = "DELETE FROM `quiz` WHERE `QuizID`= $qid";
  $conn->query($sqldel);
  $conn->query($sqldelq);
}// if the test has 0 tries left delete the test and questions belonging to it

if ($achievedscore == 1){// if the user has achieved 100 percent award them with the badge if the test has one
}

$achievedscore_perc = $achievedscore * 100;

$sqlstatins = "INSERT INTO `statistics`(`UserID`, `QuizID`, `QuizTitle`, `Percentage_`) VALUES ('$uid','$qid','$title','$achievedscore_perc')";
$conn->query($sqlstatins);
if($achievedscore == 1){
  $sqlbadge = "SELECT * FROM `badges` WHERE `BadgeQuiz` = $qid";
  $resbadge = $mysqli->query($sqlbadge);
  if ($resbadge -> num_rows==1){
  $rowbadge = mysqli_fetch_assoc($resbadge);
  $badgeid = $rowbadge['BadgeID'];
  $sqlbadgeins = "INSERT INTO `badgeuser`(`UserID`, `BadgeID`) VALUES ('$uid','$badgeid')";
  if ($conn->query($sqlbadgeins) === TRUE){
    header("location:Logout.php");
    }
  }
}
header("location:Logout.php");
$conn->close();
?>