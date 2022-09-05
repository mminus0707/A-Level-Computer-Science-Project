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
        <title>Tests</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
        function getid(questionid) {
            document.getElementById("testid").value = questionid;
            document.getElementById("testidform").submit();
        }
        </script>
    </head>
    <body>
        <?php
            if(isset($_SESSION["rank"])){
            $rank = $_SESSION["rank"];
            }
        ?>
        <div class="header">
            <p class="Title"> Welcome <?php
                        if(isset($_SESSION["name"])){
                            $name = $_SESSION["name"];
                            echo "<span>$name</span>";
                        }
                    ?></p>
            <div> <!--navbar-->
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="shop.php" style="text-decoration: none"> Shop </a>
                <a class="button" href="social.php" style="text-decoration: none"> Social </a>
                <a class="button" href="statistics.php" style="text-decoration: none"> Statistics </a>
                <hr>     
            </div> 
        </div>
        <div id="container">
            <p style="color:white;">Available Tests</p>
        <form method="post" action="quizsearch.php">
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
//selecting all quizes from database
$sql = "SELECT * FROM `quiz`";
$result=$mysqli->query($sql);
//creating table for them
echo "<table border='1' bordercolor=white style='color:white'>
<tr>
<th>ID</th>
<th>Title</th>
<th>Award</th>
</tr>";
//entering each one of them that is in the array the query returned
while ( $row = mysqli_fetch_assoc( $result ) ){?>
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
?>
<br>

            <a href="createtest.php" class="button" style="text-decoration:none;">Create a Test</a>
        </div>
    <!--Hidden variable for the quiz view where the id of the selected quiz will be set as the value of this variable and the form it is in will be submitted-->
        <form action="testviewprocess.php" id="testidform" method="post">
        <input id="testid" name="testid" type="hidden" value=""/>
</form> 
        
    </body>
</html>