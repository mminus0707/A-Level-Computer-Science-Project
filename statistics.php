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
        <title>Statistics</title>
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
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="shop.php" style="text-decoration: none"> Shop </a>
                <a class="button" href="social.php" style="text-decoration: none"> Social </a>
                <hr>     
            </div> 
            </div>

        </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<br>
<canvas id="myChart" style="width:100%;max-width:600px;background-color:white"></canvas>

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

$i = 0;
$uid = $_SESSION["userid"];
$sqlstat = "SELECT * FROM `statistics` WHERE `UserID` = $uid ORDER BY `StatID` DESC";
$resstat = $mysqli->query($sqlstat);

$stack = array();
$xval = array();

while ($row = mysqli_fetch_assoc( $resstat ) and $i < 5){

$qtitle = $row["QuizTitle"];
$perc = $row["Percentage_"];

array_push($stack, "$perc"); // percentage achieved by the user test by test entered
array_push($xval, "$qtitle"); //title of the questions in the array entered

$i = $i + 1; // count incremented
}
?>

<script> // x axis values extracted one by one
xValues =
<?php 
$js_array = json_encode($xval); 
echo "$js_array";
?>;
// Y axis values extracted one by one
var yValues = [
<?php
    foreach($stack as $res2){
    echo "$res2" . ",";
}
?>];
var barColors = ["red", "green","blue","orange","brown"]; // colours to be used 
//creation of the new chart
new Chart("myChart", {
  type: "horizontalBar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "Previous Tests"
    },
    scales: {
      xAxes: [{ticks: {min: 0, max:100}}]
    }
  }
});
</script>
<br>

<?php 

$rankid = $_SESSION["rank"];
// if the rank is enough for quizes there will be an potion reviews user stats on their tests
if ($rankid > 2){
echo "<a class='button' href='teststats.php' style='text-decoration:none;'> User statistics on your tests </a>";
}
?>
</body>
</html>