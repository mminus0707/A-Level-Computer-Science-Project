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
        <title>Test Statistics</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php
            if(isset($_SESSION["rank"])){
            $rank = $_SESSION["rank"];
            }
            if(isset($_SESSION["email"])){
            $email = $_SESSION["email"];
            }
        ?>
        <div class="header">
            <p class="Title"> Welcome <?php
                        if(isset($_SESSION["name"])){
                            $name = $_SESSION["name"];
                            echo "<span>$name</span>";
                        }
                    ?></p>
            <div>
                <a class="button" href="Logout.php" style="text-decoration: none"> Log out </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="shop.php" style="text-decoration: none"> Shop </a>
                <a class="button" href="social.php" style="text-decoration: none"> Social </a>
                <a class="button" href="statistics.php" style="text-decoration: none"> Statistics </a>
                <hr>     
            </div>

        </div>
<?php
if ($_SESSION["rank"] > 2)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";
$mysqli = new mysqli("localhost","root","","user");

// Check connection
if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}

$i = 0;
$uid = $_SESSION["userid"];

$sqltestperf = "SELECT * FROM `quiz` WHERE `CreatorID` = '$uid'";
$resteststat = $mysqli->query($sqltestperf);
//select each test made by the user
if ($resteststat -> num_rows > 1){
//create a form and a select inpu
echo "
<form action='teststatdisplay.php' method='post'>
<select name='quizid' id='quizid'>";

$stack = array();
//put the ids of the questions into the array
while ($rowtest = mysqli_fetch_assoc( $resteststat )){

  $qid = $rowtest["QuizID"];

  array_push($stack, "$qid");

  }

$i = 0;
$resteststat1 = $mysqli->query($sqltestperf);
//put every row into the select as an option to view with their ids
while ($rowtest1 = mysqli_fetch_assoc( $resteststat1 )){

  $qtitle = $rowtest1["Title"];
  $quizid = $stack[$i];

  echo"<option value='$quizid'> $qtitle </option>;";
  $i = $i + 1;
  }
//close the select and add a submti button
echo"</select>
<br>
<button type='submit' class='button'> Submit </button>
</form>
";
}else{// if there are no tests made under the user this will be displayed
    echo"<p style='color:white'> No tests have been found under your name </p>";
}
?>

    </body>
</html>