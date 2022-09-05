<?php
session_start();
//validation that the user is logged in
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
            $pid = $_SESSION['ProfileID'];
            $sqlprofiledetails = "SELECT * FROM `user_details` WHERE `UserID` = $pid";
            $res=$mysqli->query($sqlprofiledetails);
            $row = mysqli_fetch_assoc($res);
            $ranknames = array("NULL","Guest", "Member", "Trusted", "Respected", "Moderator","Admin");
            $rankname = $ranknames[$row["RankID"]];
            $pname = $row["Name"];
            $email = $row["Email"];
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
                <hr>     
            </div>

        </div>
        <!--using the information retrieved from the previous page to display another user's profile-->
        <div id="container">
        <p style="color:white; font-size:18px;">Username: <?php echo "<span>$pname</span>";?></p>
        <p style="color:white; font-size:18px;">Email: <?php echo "<span>$email</span>";?></p>
        <label style="color:white; font-size:18px; ">Rank: </label><img src="<?php echo $rankname?>.png" width="25px"><p style="color:white; font-size:18px; display:inline-block;"><?php echo "<span>$rankname</span>";?></p>
    </body>
</html>