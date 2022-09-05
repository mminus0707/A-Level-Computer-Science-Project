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
        <title>Create Test</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
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
            <div>
                <!--navbar-->
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>

                <hr>     
            </div>

        </div>
        <div id="container">
            <p style="color:white; font-size:24px;"> Creating a Test</p>
            <p style="color:white;">
            <?php
            // validation of user being able to create tests if the user is able to then they will be redirected
            if($rank < 2){
                echo "<span> You need to be Trusted in order to create tests $name</span>";
            }else{
                header("location: testedit.php");
            }
            ?>
            </p>
        </div>
    </body>
</html>
