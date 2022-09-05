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

$user = $_POST["username"];

$sqlid = "SELECT * FROM `user_details` WHERE `Name` = '$user'";
$sqlidres = $mysqli->query($sqlid);
$rowid = mysqli_fetch_assoc($sqlidres);
$id = $rowid['UserID'];
// retrieve userid from the database
$sqlcal = "SELECT * FROM `points` WHERE `UserID` = $id";
$sqlcalres = $mysqli->query($sqlcal);
$rowpointcal = mysqli_fetch_assoc($sqlcalres);
//new balance calculated
$award = $_SESSION["RewardQ"] + $rowpointcal['Points'];
$expu = $rowpointcal["Experience"];
//updating the balance
$sqlpoint = "UPDATE `points` SET `Points` = $award WHERE `UserID` = $id";
$sqlpointrun = $mysqli->query($sqlpoint);

$qid = $_SESSION["QuestionID"];
// marking the question as complete
$sqldone = "UPDATE `singularquestions` SET `Complete`=1 WHERE `SQuestionID`= $qid";
$sqldonerun = $mysqli->query($sqldone);
// removing the award
$sqldone = "UPDATE `singularquestions` SET `Award`=0 WHERE `SQuestionID`= $qid";
$sqldonerun = $mysqli->query($sqldone);

$creatorname = $_SESSION["QName"];

//validation that the creator of the question isn't rewarding themselves
if ($creatorname != $user){

$sqlpointsub = "SELECT * FROM `user_details` WHERE `Name` = '$creatorname'";
$sqlpointsubres = $mysqli->query($sqlpointsub);
$rowpointsub = mysqli_fetch_assoc($sqlpointsubres);

$creatorid = $rowpointsub["UserID"];
//creator id retrieved
$sqlcalc = "SELECT * FROM `points` WHERE `UserID` = '$creatorid'";
$sqlcalresc = $mysqli->query($sqlcalc);
$rowpointcalc = mysqli_fetch_assoc($sqlcalresc);
//points experience and spoints are retrieved
$pointc = $rowpointcalc["Points"];
$spoint = $rowpointcalc["SPoints"];
$expc = $rowpointcalc["Experience"];
//spoint award is calculated
$spointaward = ($_SESSION["RewardQ"] / 100) + $spoint;
//substracting the points from the balance
$awardsub = $pointc - $_SESSION["RewardQ"];
//updating spoint balance
$sqlpoint2 = "UPDATE `points` SET `SPoints` = $spointaward WHERE `UserID` = '$creatorid'";
$sqlpointrun2 = $mysqli->query($sqlpoint2);
//updating the point balance
$sqlpoint1 = "UPDATE `points` SET `Points` = $awardsub WHERE `UserID` = '$creatorid'";
$sqlpointrun1 = $mysqli->query($sqlpoint1);
// calculating the new experinces
$expca = $expc + $_SESSION["RewardQ"];
$expua = $expu + $_SESSION["RewardQ"];
// updating the experiences
$sqlpoint2 = "UPDATE `points` SET `Experience` = $expca WHERE `UserID` = '$creatorid'";
$sqlpointrun2 = $mysqli->query($sqlpoint2);

$sqlpoint2 = "UPDATE `points` SET `Experience` = $expua WHERE `UserID` = '$id'";
$sqlpointrun2 = $mysqli->query($sqlpoint2);

header("location: questions_home.php");
} else{
header("location: Logout.php");
}
$conn->close();

?>