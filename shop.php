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
        <title>Store</title>
        <script>
        function getid(itemid) {
            document.getElementById("itemid").value = itemid;
            document.getElementById("purchaseidform").submit();
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
            <div> <!--navbar-->
            <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="social.php" style="text-decoration: none"> Social </a>
                <a class="button" href="statistics.php" style="text-decoration: none"> Statistics </a>
                <hr>     
            </div>

        </div>
        <p id="user_balance" style="color:white;"> 

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

if(isset($_SESSION["userid"])){
    $userid = $_SESSION["userid"];
}
//retrieving the balance of the user
$sql = "SELECT * FROM `points` WHERE `UserID`='$userid'";
$result=$mysqli->query($sql);
$row = mysqli_fetch_assoc($result);
$points = $row["Points"];
$spoints = $row["SPoints"];

echo "
Points: $points
SPoints: $spoints";
//printing the balance
?>
        </p>
        <div name="Items">
        
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

$sql2 = "SELECT * FROM `items`";
$result2=$mysqli->query($sql2);
//creating the table for the items
echo "<table border='1' bordercolor=white style='color:white'>

<tr>
<th>ID</th>
<th>Item</th>
<th>Price</th>
<th>SPrice</th>
</tr>";
//inserting them to the table
while ( $row = mysqli_fetch_assoc( $result2 ) ){?>
    <tr>
      <td id="qid" name="qid"><?=$row['ItemID']?></td>
      <td id="Item" name="Item"><?=$row['Item']?></td>
      <td id="Price" name="Price"><?=$row['Price']?></td>
      <td id="SPrice" name="SPrice"><?=$row['SPrice']?></td>
      <td><button onclick="getid(<?=$row['ItemID']?>)">Click to Purchase</button></td>
    </tr>
<?php
}
//closing the table
echo "</table>";
?>
<form action="purchaseprocess.php" id="purchaseidform" method="post">
        <input id="itemid" name="itemid" type="hidden" value=""/>
</form> 

<!--if the user is an admin they will have the option to add an item-->
<?php 
$rank = $_SESSION["rank"];
if ($rank == 6) {?>
<br>
<form action="additem.php">
<input type="submit" value="Add Item" class="button">
</form>
<?php } ?>
        </div>
    </body>
</html>
