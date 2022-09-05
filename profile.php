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
        <title>Profile</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
    </head>
    <body>
        <?php
            $mysqli = new mysqli("localhost","root","","user");
            if(isset($_SESSION["email"])){
            $email = $_SESSION["email"];
            }
            if(isset($_SESSION["rank"])){
            $rank = $_SESSION["rank"];
            }
            // sql that retrieves the rank of the user
            $sqlrank = "SELECT `Rank` FROM `ranknames` WHERE `RankID`='$rank'";
            $resrank=$mysqli->query($sqlrank);
            $row = mysqli_fetch_assoc($resrank);
            $rankname = $row["Rank"];
            $rank = $rank + 1;
            //sql for the next rank
            $sqlnextrank = "SELECT * FROM `ranknames` WHERE `RankID`='$rank'";
            $resnextrank=$mysqli->query($sqlnextrank);
            $rownextrank = mysqli_fetch_assoc($resnextrank);
            // if the rank is admin there will be no next rank else there will be a next rank displayed
            if ($rankname != "Admin"){
            $nextrankname = $rownextrank["Rank"];
            $nextrankexp = $rownextrank["PointRequire"];
            }
            // retieving the experience
            $sqlexp = "SELECT * FROM `user_details` WHERE `Email` = '$email'";
            $ressqlexp=$mysqli->query($sqlexp);
            $rowexp = mysqli_fetch_assoc($ressqlexp);
            $uid = $rowexp["UserID"];
            $sqlexp2 = "SELECT * FROM `points` WHERE `UserID` = $uid";
            $resexp2=$mysqli->query($sqlexp2);
            $rowexp2 = mysqli_fetch_assoc($resexp2);
            $exp = $rowexp2["Experience"];
            
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
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="shop.php" style="text-decoration: none"> Shop </a>
                <a class="button" href="social.php" style="text-decoration: none"> Social </a>
                <a class="button" href="statistics.php" style="text-decoration: none"> Statistics </a>
                <hr>     
            </div>

        </div>
        <!--profile details structure-->
        <div id="container">
        <p style="color:white; font-size:18px;">Username: <?php echo "<span>$name</span>";?></p>
        <p style="color:white; font-size:18px;">Email: <?php echo "<span>$email</span>";?></p>
        <label style="color:white; font-size:18px; ">Rank: </label><img src="<?php echo $rankname?>.png" width="25px"><p style="color:white; font-size:18px; display:inline-block;"><?php echo "<span>$rankname</span>";?></p>
        <p style="color:white; font-size:18px;">Experience: <?php echo "<span>$exp</span>";?></p>
        <?php if ($rankname != "Admin"){?>
        <label style="color:white; font-size:18px; ">Next rank: </label><img src="<?php echo $nextrankname?>.png" width="25px"><p style="color:white; font-size:18px; display:inline-block;"><?php echo "<span>$nextrankname</span>";?></p> 
        <?php
        if ($exp >= $nextrankexp){
            $sqlrankup = "UPDATE `user_details` SET `RankID` = $rank WHERE `Email` = '$email'";
            $sqlrankup = $mysqli->query($sqlrankup);
            echo"<br><p style='color:white'>Congratulations You have reached a new Rank, Log out and Log back in to see your new rank</p>";
        }
        ?>
        <br>
        <?php if(isset($_SESSION["testerror"])){
            ?>
        <p style="color:white"> <?php $err = $_SESSION["testerror"];
        echo("$err");
        unset($_SESSION['testerror']);
        $err = ""; ?> </p>
    
        
        <?php
        }
    }
        ?>
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
$uid = $_SESSION["userid"];
$sql = "SELECT * FROM `inventory` WHERE `UserID` = '$uid'";
$result=$mysqli->query($sql);
//inventory table created
echo "<table border='1' bordercolor=white style='color:white'>
<tr>
<th>Inventory</th>
</tr>";
// entering records into the table
while ( $row = mysqli_fetch_assoc( $result ) ){
    $itemid = $row['ItemID'];
    $sql2 = "SELECT * FROM `items` WHERE `ItemID`= '$itemid'";
    $sqlinameres = $mysqli->query($sql2);
    $row2 = mysqli_fetch_assoc($sqlinameres);
    ?>
    <tr>
      <td id="item" name="item"><?=$row2['Item']?></td>
    </tr>
<?php
}

echo "</table>";
?>

<?php
$sqlbadges = "SELECT * FROM `badgeuser` WHERE `UserID` = '$uid'";
$resultbadges=$mysqli->query($sqlbadges);
//making a badge table
echo "<table border='1' bordercolor=white style='color:white;margin-left:25%;margin-top:-35px'>
<tr>
<th>Badges</th>
</tr>";
//printed the inventory
// entering records into the table
while ( $rowbadges = mysqli_fetch_assoc( $resultbadges ) ){
    $badgeid = $rowbadges['BadgeID'];
    $sql2badge = "SELECT * FROM `badges` WHERE `BadgeID`= '$badgeid'";
    $sqlbadgeres = $mysqli->query($sql2badge);
    $row2badges = mysqli_fetch_assoc($sqlbadgeres);
    $badgename = $row2badges['BadgeName'];
    ?>
    <tr>
      <td id="badge" name="badge"><?=$badgename?></td>
    </tr>
<?php
}

echo "</table>";
//closing the badge table
?>
        <br>
        <a class="button" href="changepassword.php" style="text-decoration:none;">Change Password</a>
        </div>

    </body>
</html>