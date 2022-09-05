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
            $quizid = $_POST["quizid"];
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
// boundaries for the percentages 
$lt25 = 0;
$gt25lt50 = 0;
$gt50lt75 = 0;
$gt75 = 0;
$total = 0;
$totalperc = 0;
//retrieve the quiz details
$sqlquiztitle = "SELECT * FROM `quiz` WHERE `QuizID` = '$quizid'";
$ressqlquiztitle = $mysqli ->query($sqlquiztitle);
$rowtitle = mysqli_fetch_assoc($ressqlquiztitle);

$title = $rowtitle["Title"];

//retrieve the statistics related to the test form the database
$sqlstat = "SELECT * FROM `statistics` WHERE `QuizID` = '$quizid'";
$resstat = $mysqli -> query($sqlstat);

$arr = array();

if ($resstat->num_rows > 1){
//if there is more than one rows of result add them to the graph
while ($row = mysqli_fetch_assoc($resstat)){
    $total = $total + 1; // increment the total number of people who took the test
    $totalperc = $totalperc + $row['Percentage_']; // calculate the total percentage
    //increment the corresponding boundaries
    if($row['Percentage_'] < 26){
      $lt25 = $lt25 + 1;
    } 
    if (($row['Percentage_'] > 25) and ($row['Percentage_'] < 51)){
      $gt25lt50 = $gt25lt50 + 1;
    }
    if (($row['Percentage_'] > 50) and ($row['Percentage_'] < 76)){
      $gt50lt75 = $gt50lt75 + 1;
    }
    if ($row['Percentage_'] > 75){
      $gt75 = $gt75 + 1;
    }
}

array_push($arr, $lt25);
array_push($arr, $gt25lt50);
array_push($arr, $gt50lt75);
array_push($arr, $gt75);
// add the boundaries to the array
$average = $totalperc / $total;
}else {
  $arr = [];
  $average = 0;
}//calculate the average score
?>

<script>
//create a new chart
new Chart("myChart", {
  type: "pie",
  data: {
    labels: [
    'Less than 25%',
    'Greater than 25% Less than or equal to 50%',
    'Greater than 50% Less than or equal to 75%',
    'Greater than 75%'
  ],
    datasets: [{
      backgroundColor: [
      'rgb(168, 50, 50)',
      'rgb(168, 109, 50)',
      'rgb(115, 168, 50)',
      'rgb(50, 168, 56)'
    ],//extract the array for the pie chart
      data: <?php $js_array = json_encode($arr); echo "$js_array";?>,
    }]
  },
  options: {
    title: {
      display: true,
      text: "<?php echo "$title"?>",
    }
  }
});
</script>
<br>
<?php if ($average > 0){?>
<p style="color:white"> Average percentage achieved by users: <?php echo"$average" ?>%</p>
<?php 
}else{
?> 
<p style="color:white"> No one has taken the test successfully</p>
<?php }?>
</body>
</html>