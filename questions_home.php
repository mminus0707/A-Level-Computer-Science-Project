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
        <title>Questions</title>
        <script>
        function getid(questionid) {
            document.getElementById("questionid").value = questionid;
            document.getElementById("questionidform").submit();
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
            <!-- NAVBAR --> 
            <div>
            <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
            <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
            <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
            <a class="button" href="shop.php" style="text-decoration: none"> Shop </a>
            <a class="button" href="social.php" style="text-decoration: none"> Social </a>
            <a class="button" href="statistics.php" style="text-decoration: none"> Statistics </a>
                <hr>     
            </div>

        </div>
        <div name="Questions">
        <p class="header"> Here are some questions asked by other users</p>
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

$sql = "SELECT * FROM `singularquestions`";
$result=$mysqli->query($sql);

echo "<table border='1' bordercolor=white style='color:white'>
<tr>
<th>ID</th>
<th>Title</th>
<th>Award</th>
</tr>";
// entering records into the table
while ( $row = mysqli_fetch_assoc( $result ) ){?>
    <tr>
      <td id="qid" name="qid"><?=$row['SQuestionID']?></td>
      <td id="Title" name="Title"><?=$row['Title']?></td>
      <td id="Award" name="Award"><?=$row['Award']?></td>
      <td><button onclick="getid(<?=$row['SQuestionID']?>)">Click to View</button></td>
    </tr>
<?php
}
//closing the table
echo "</table>";
?>

        <p class="header"> Can't find what you are looking for ? <a style="text-decoration: none;color:white" href="askquestions.php"> Click here to ask a question </a> </p>
    <!--form which will be used to submit which qusetion is to be reviewed-->
        <form action="questionviewprocess.php" id="questionidform" method="post">
        <input id="questionid" name="questionid" type="hidden" value=""/>
</form> 
<p style="color:white" >
<!--if the user doesnt have enough point to ask a question the error will be displayed here-->
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
