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
        <title>Home</title>
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
                <!-- navbar-->
                <a class="button" href="Logout.php" style="text-decoration: none"> Log out </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="shop.php" style="text-decoration: none"> Shop </a>
                <a class="button" href="social.php" style="text-decoration: none"> Social </a>
                <a class="button" href="statistics.php" style="text-decoration: none"> Statistics </a>
                <hr>     
            </div> 

        </div>
        <!--Data will be retrieved from the database with the code below for the tables-->
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

$sql = "SELECT * FROM `quiz` ORDER BY `NumEntries` DESC";
$result=$mysqli->query($sql);
// html table created here with desired fields
echo "<table border='1' bordercolor=white style='color:white; float: left;'>
<caption> Featured Tests </caption>
<tr>
<th>ID</th>
<th>Title</th>
<th>Award</th>
</tr>";

$i = 0;
//loop that will continously enter data into the table for 5 iterations
while ( $row = mysqli_fetch_assoc( $result ) and $i < 5){?>
    <tr>
    <form action="">
      <td name="qid"><?=$row['QuizID']?></td>
      <td id="Title" name="Title"><?=$row['Title']?></td>
      <td id="Award" name="Award"><?=$row['MaxPoint']?></td>
</form>
    </tr>
<?php
$i += 1;
}
//printing of the table
echo "</table>";
?>

<?php

$sql2 = "SELECT * FROM `points` ORDER BY `SPoints` DESC";
$result2=$mysqli->query($sql2);
//table created for the eladerboard
echo "<table border='1' bordercolor=white style='color:white;display: inline-block; margin-left:50px;'>
<caption> SPoint Leaderboard </caption>
<tr>
<th>ID</th>
<th>Username</th>
<th>SPoint</th>
</tr>";

$i = 0;
//loop that will cycle and add top 5 spoint accounts to the table
while ( $row2 = mysqli_fetch_assoc( $result2 ) and $i < 5){
    $id = $row2['UserID'];
    $sqluname = "SELECT * FROM `user_details` WHERE `UserID` = $id";
    $resultname=$mysqli->query($sqluname);
    $resname = mysqli_fetch_assoc($resultname)?>
    <tr>
    <form action="">
      <td><?=$row2['UserID']?></td>
      <td><?=$resname['Name']?></td>
      <td><?=$row2['SPoints']?></td>
</form>
    </tr>
<?php
$i += 1;
}
//closing of the table
echo "</table>";
?>
    </body>
</html>
