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
        <title>Ask Question</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
        function validation(){
        var y = document.getElementById("question").value;
        var x = document.getElementById("award").value;
        var z = document.getElementById("title").value;
        //if question is empty
        if(y == ""){
            document.getElementById("qer").innerHTML="Enter your question";
        }
        //if award is less than 100
        if(x < 100){
            document.getElementById("aer").innerHTML="At least 100 points";
        }
        // if title is empty
        if(z == ""){
            document.getElementById("ter").innerHTML="Enter your Title";
        }
        // if title length is greater than 32
        if(z.length > 32){
            document.getElementById("ter").innerHTML="Length of your title can not be greater than 72 characters";
        }
        if(y != "" && x != "" && x > 99){
            document.getElementById("questionform").submit(); 
        }
        }
        </script>
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
                <a class="button" href="Logout.php" style="text-decoration: none"> Log out </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <hr>     
            </div>

            <form action="askquestions2.php" method="post" id="questionform"> 
                <!--Title-->
            <label style="color:white;"> Title</label><br>
            <input type="text" id="title" name="title"> <br>       
            <!--Question itself -->         
            <label style="color:white;"> Question</label><br>
            <input type="text" id="question" name="question"> <br>
            <!-- Award-->
            <label style="color:white;"> Award</label><br>
            <input type="number" id="award" name="award" min="100" max="500"><br>
            <!-- Validation button-->
            <input onclick="validation()" type="button" class="button" style="margin-top:3%" value="Submit">
            <!-- Error paragraphs-->
            <p style="color:white"id="ter"></p></br>
            <p style="color:white"id="qer"></p></br>
            <p style="color:white"id="aer"></p>
            </form>
        </div>

    </body>
</html>
