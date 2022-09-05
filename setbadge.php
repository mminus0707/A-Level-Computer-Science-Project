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
        <title>Add badge </title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
            //validation of the badge to be added
        function validation(){
        var z = document.getElementById("title").value;
        if((z.length > 32) || (z.length < 6)){
            document.getElementById("ter").innerHTML="Length of the name of your badge can not be greater than 32 characters or less than 6";
        }
        if((z.length > 6) && (z.length < 32)){
            document.getElementById("questionform").submit(); 
        }
        }
        </script>
    </head>
    <body>
        <?php
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
                <a class="button" href="Logout.php" style="text-decoration: none"> Log out </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <hr>     
            </div>
            <!--form for the badge -->
            <form action="addbadge2.php" method="post" id="questionform"> 
            <label style="color:white;"> Badge name</label><br>
            <input type="text" id="title" name="title"> <br>                
            <input onclick="validation()" type="button" class="button" style="margin-top:3%" value="Submit">
            <p style="color:white"id="ter"></p></br>
            </form>

            <label> If you don't want to add a badge please click <a style="text-decoration:none; color:white" href="quizes.php">here</a><l/abel>
        </div>

    </body>
</html>
