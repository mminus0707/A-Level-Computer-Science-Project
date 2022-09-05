<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Enter Question</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
        function validation(){//validating the answer and the question itself making sure that they arent empty
        var y = document.getElementById("question").value;
        var x = document.getElementById("answer").value;
        if(y == ""){
            document.getElementById("qer").innerHTML="Enter your question";
        }
        if(x == ""){
            document.getElementById("aer").innerHTML="Enter your answer";
        }
        if(y != "" && x != ""){
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

        ?>
        <div class="header">
            <p class="Title"> Welcome <?php
                        if(isset($_SESSION["name"])){
                            $name = $_SESSION["name"];
                            echo "<span>$name</span>";
                        }
                    ?></p>
            <div>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <hr>     
            </div>

        </div>
        <div>
        <p style="color:white; font-size:24px;"> Creating a Test</p>
        <p style="color:white;">
        <?php // counter for the remaining questions
        $numq = $_SESSION['questions'];
        echo"$numq";
        $_SESSION['done'] = False;
        ?> Questions left </p>
        <!--Form for the questions-->
        <form action="setquestions2.php" method="post" id="questionform"> 
        <label style="color:white;"> Question</label><br>
        <input type="text" id="question" name="question"> <br>
        <label style="color:white;">Answer</label><br>
        <input type="text" id="answer" name="answer"> <br>
        <input onclick="validation()" type="button" class="button" style="margin-top:3%" value="Submit">
        <p style="color:white"id="qer"></p>
        <p style="color:white"id="aer"></p>
        </form>
        </div>
    </body>
</html>
