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

$_SESSION['questions']=$_POST['numques']-1;
$award=$_POST['award'];
$tries=$_POST['try']  ;
$title=$_POST["title"];
$numquestion = $_SESSION["questions"];
$userid = $_SESSION["userid"]; 
//retrieving information form previous page
$dataq = $numquestion + 1;

$sql="insert into quiz (Maxpoint,NumQuestion,NumEntries,CreatorID,Title)
values('$award','$dataq','$tries','$userid','$title');";

$_SESSION['award'] = $award;

$sql2 = "SELECT `QuizID` from `quiz` ORDER BY `QuizID` DESC";
$res = $mysqli->query($sql2);
$row = mysqli_fetch_assoc($res);

// here the code bugged out so I had to imrpovise basically there has to be at least 2 records in the database already for this to work
// so what I did here was if the results were less than 2 the code below would fix the problem
$i = 0;
while ( $row = mysqli_fetch_assoc( $res ) and $i < 1 ){
  $_SESSION["QuizID"] = $row["QuizID"] + 2;
  $i += 1;
}
if ($res -> num_rows<2){
  $_SESSION["QuizID"] = $row["QuizID"] + 1;
}

if ($conn->query($sql) === TRUE)
    header("location:setquestions.php");
?>