<?php
session_start();

if ($_SESSION['logged_in'] != true){
    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Question View</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
            //validation of the answer to be posted
        function validation() {
        if(document.getElementById("answer_container").value.length < 1){
          document.getElementById("answer_container").style.border="2px solid red";          
          document.getElementById("answer_container").placeholder="Enter your answer";
        }if(document.getElementById("answer_container").value.length > 1){
            document.getElementById("answer").submit(); 
        }
    }
        </script>
    </head>
    <body>
        <div class="header">
            <p class="Title"> Welcome <?php
                        if(isset($_SESSION["name"])){
                            $name = $_SESSION["name"];
                            echo "<span>$name</span>";
                        }
                    ?></p>
            <div>
                <a class="button" href="Logout.php" style="text-decoration: none"> Log out </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <hr>     
            </div>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";
$mysqli = new mysqli("localhost","root","","user");

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$qid = $_SESSION['QuestionID'];

$sql = "SELECT * FROM `singularquestions` WHERE `SQuestionID` = '$qid'";
//retrieves the details about the question
$res=$mysqli->query($sql);

$row = $res -> fetch_assoc();
$_SESSION["Complete"] = $row["Complete"];
$_SESSION["Title"] = $row["Title"];
$_SESSION["Question"] = $row["Question"];
$_SESSION["RewardQ"] = $row["Award"];
$creator = $row['CreatorID'];
// sets them as session variables
$sql2 = "SELECT * FROM `user_details` WHERE `UserID` = '$creator'";
//retrieves the creator name
$res2=$mysqli->query($sql2);

$row2 = mysqli_fetch_assoc($res2);

$_SESSION["QName"] = $row2["Name"];

?>
<h1><?=$_SESSION['Title']?></h1><br>
<p><?=$_SESSION['Question']?></p><br>
<p> Asked by <?=$_SESSION['QName']?></p>


</div>
<?php 
// if the question isnt complete the creator would have the option to award someones answer
if ($_SESSION['QName'] == $_SESSION['name'] && $_SESSION["Complete"] == 0){
    //adding the select input to the html
    echo "
    <label style='color:white'> Choose a User to Reward </label>
    <form id=''action='pointquestion.php' method='post'>
    <select name='username' id='username'>";
    $questionid = $_SESSION['QuestionID'];
    $sqlanswer0_ = "SELECT * FROM `questionanswers` WHERE `QuestionID` = $questionid";
    $sqlanswerres = $mysqli->query($sqlanswer0_);
    //adding options to the select input
    while ( $rowanswer_ = mysqli_fetch_assoc( $sqlanswerres ) ){
        $id = $rowanswer_['UserID'];
        $sqlname = "SELECT * FROM `user_details` WHERE `UserID` = $id";
        $sqlnameres=$mysqli->query($sqlname);
        $rowname = mysqli_fetch_assoc($sqlnameres);
        $_SESSION["AnswerUser"] = $rowname['Name'];

        $username = $_SESSION["AnswerUser"];
        echo"<option value='$username'> $username </option>;";
    }
    //closing the select
echo"</select>
<input type='submit' class='button'>
</form>
<br>";
    }

?>
    <form id="answer" name="answer" method="post" action="answerproc.php">
    <label style="color:white;"> Post an Answer </label> <br>
    <input class="input" type="text" name="answer_container" id="answer_container" size="100" height="108"> <br>
    <input onclick="validation()" type="button" class="button" style="margin-top:3%" value="Submit">
    </form>

<?php
$questionid = $_SESSION['QuestionID'];

$sqlanswer0 = "SELECT * FROM `questionanswers` WHERE `QuestionID` = $questionid";
$sqlanswer=$mysqli->query($sqlanswer0);
//printing each answer
while ( $rowanswer = mysqli_fetch_assoc( $sqlanswer ) ){
    $id = $rowanswer['UserID'];
    $sqlname = "SELECT * FROM `user_details` WHERE `UserID` = $id";
    $sqlname0 = $mysqli->query($sqlname);
    $rowname=mysqli_fetch_assoc($sqlname0);
    $name = $rowname['Name'];
    $answer = $rowanswer['AnswerText'];
    $rank = $rowname["RankID"];
    $sqlrank = "SELECT * FROM `ranknames` WHERE `RankID` = $rank";
    $sqlrank0 = $mysqli->query($sqlrank);
    $rowrank=mysqli_fetch_assoc($sqlrank0);
    $rankname=$rowrank['Rank'];
    //printing the actual answer alongside the username and rank icon
    echo "<p style='color:white'>$answer By $name <img src='$rankname.png' width='25px'><br>";
}
?>
    
    </body>
</html>
