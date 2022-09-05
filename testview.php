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
        <title>View Test</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
        let score = 0;

        function checkans(ans, cansw, id) {
            //function used to check each question against their answers and increment the score variable which will be forwarded to the next page
        if (ans.value == cansw.value){
            document.getElementById(id).innerHTML = "<p style='color:white'> Correct </p>";
            score = score + 1;
            document.getElementById("score").value = score;

        }else{
            document.getElementById(id).innerHTML = "<p style='color:white'> Wrong </p>";
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
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <hr>     
            </div>
<form id="test" action="testprocess.php" method="post">
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

$testid = $_SESSION['TestID'];

$sql2 = "SELECT * FROM `quiz` WHERE `QuizID` = '$testid'";
//retrieve quiz details
$res2=$mysqli->query($sql2);

$row2 = mysqli_fetch_assoc($res2);

$_SESSION["TTitle"] = $row2["Title"];

?>
<h1><?=$_SESSION['TTitle']?></h1><br>

</div>

<?php

$testid = $_SESSION['TestID'];

$sqlq = "SELECT * FROM `questions` WHERE `QuizID` = $testid";
$sqlqa=$mysqli->query($sqlq);
//get each question from the questions table
//print them on the page with their corresponding ansers but as a hidden variable
while ( $rowanswer = mysqli_fetch_assoc( $sqlqa ) ){
    $question = $rowanswer['question'];
    $answer = $rowanswer['answer'];
    $id = $rowanswer['questionID'];
    echo "<div id='$id'><p style='color:white'>$question</p> <input type='text' name='uanswer' id='uanswer$id'> </input> <input type='hidden' name='answer' id='answer$id' value='$answer'> </input> <button onclick='checkans(uanswer$id, answer$id, $id)'> Check Answer </button> </div>";
}
?>
    <br>
    <br>
    <input type="hidden" value="0" id="score" name="score"> </input>
    <input type="submit" class="button">
</form>
    </body>
</html>
