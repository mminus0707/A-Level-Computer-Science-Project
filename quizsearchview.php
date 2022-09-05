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
        <title>Search Results</title>
        <script>
        function getid(quizid) {
            document.getElementById("quizid").value = questionid;
            document.getElementById("quizidform").submit();
        }
        </script>
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
            <div><!--navbar -->
                <a class="button" href="Logout.php" style="text-decoration: none"> Log out </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <hr>     
            </div>

        </div>
        <div name="Questions">
        <form method="post" action="questionsearch.php">
            <input type="text" name="Search" id="Search"> <input type="submit" value="Search">
        </form>
        <br>
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
if ($_SESSION['SearchResQ'] != "No items were found"){
    //creating the tablef or the results
echo "<table border='1' bordercolor=white style='color:white'>

<tr>
<th>ID</th>
<th>Title</th>
<th>Award</th>
</tr>";
$sql = $_SESSION['SearchResQ'];

$res = $mysqli->query($sql);
//inserting each result
while ( $row = mysqli_fetch_assoc( $res ) ){?>
    <tr>
      <td name="qid"><?=$row['QuizID']?></td>
      <td id="Title" name="Title"><?=$row['Title']?></td>
      <td id="Award" name="Award"><?=$row['MaxPoint']?></td>
      <td><button onclick="getid(<?=$row['QuizID']?>)">Click to View</button></td>
    </tr>
<?php
}
//closing the table
echo "</table>";
} else{
    $message = $_SESSION['SearchRes'];
    echo"<p style='color:white'>$message</p>";
}
?>
        <p class="header"> Can't find what you are looking for ? <a style="text-decoration: none;color:white" href="askquestions.php"> Click here make your own test </a> </p>
    <form action="questionviewprocess.php" id="questionidform" method="post">
        <input id="questionid" name="questionid" type="hidden" value=""/>
</form> 
<p style="color:white" >
    <?php 
    if(isset($_SESSION["Pointerror"])){
    $error = $_SESSION['Pointerror'];
    echo"$error";
    }
    ?>
</p>
    </div>
    </body>
</html>
