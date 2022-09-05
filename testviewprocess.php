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

$qid = $_POST["testid"];

$_SESSION["TestID"] = $qid;

$id = $_SESSION['userid'];

$sqltestid = "SELECT * FROM `quiz` WHERE `QuizID` = $qid";
$restestid = $mysqli->query($sqltestid);
$rowid = mysqli_fetch_assoc($restestid);

$cid = $rowid['CreatorID'];
$entries = $rowid['NumEntries'];

if($entries > 0){
if ($cid == $id){ // validation that creator can not take their own test
  header("location:quizes.php");
}else{
  $sqltestcheck = "SELECT * FROM `taken_tests` WHERE `UserID` = $id AND `QuizID` = $qid";
  $restest = $mysqli->query($sqltestcheck);
  if ($restest -> num_rows < 1){ // if the user has taken the test before they can not take it again this is the validation for it
    $sqltaken="insert into taken_tests (QuizID,UserID) values('$qid','$id')";
    if($conn->query($sqltaken) === TRUE){
    header('location:testview.php');
    }else{
      echo('error');
    }}else{
      header("location:quizes.php");
    }
  }
echo " ERROR ";
$conn->close();
}
?>