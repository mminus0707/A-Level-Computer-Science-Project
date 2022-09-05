<?php
session_start();
$rank = $_SESSION["rank"];

if ($rank < 3){
    $_SESSION["testerror"] = "In order to create a test you at least need to be Trusted";
    header("location:profile.php");
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Test creation</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
        function validation(){
        var y = document.getElementById("numques").value;
        var x = document.getElementById("award").value;
        var z = document.getElementById("try").value;
        var i = document.getElementById("title").value;
        // checking for the number of questions
        if(y < 5 || y > 20){
            document.getElementById("qer").innerHTML="At least 5, at most 20 questions";
        }//point awards validaiton
        if(x < 100 || x > 1000){ 
            document.getElementById("aer").innerHTML="At least 100, at most 1000 points";
        }//num of tries validation
        if(z < 10 || z > 100){
            document.getElementById("ter").innerHTML="At least 10, at most 100 tries";
        }//title validation
        if(i == ""){
            document.getElementById("titler").innerHTML="Give your test a title";
        }if(x > 99 && x < 1001 && y > 4 && y < 21 && z > 9 && z < 101 && i != ""){
            document.getElementById("testdet").submit(); 
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
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <hr>     
            </div>

        </div>
        <div>
        <p style="color:white; font-size:24px;"> Creating a Test</p>
        <form action="testedit2.php" method="post" id="testdet"> 
        <label style="color:white;"> Title</label><br>
        <input type="text" id="title" name="title"> <br>
        <label style="color:white;"> Number of Questions, Least 5, Most 20 questions</label><br>
        <input type="number" id="numques" name="numques" min="5" max="20"> <br>
        <label style="color:white;"> 100% Award, Least 100, Most 1000 points</label> <br>
        <input type="number" id="award" name="award" min="100" max="1000"><br>
        <label style="color:white;"> Number of Tries</label> <br>
        <input type="number" id="try" name="try" min="10" max="100"><br>
        <input onclick="validation()" type="button" class="button" style="margin-top:3%" value="Submit">
        <p style="color:white"id="qer"></p>
        <p style="color:white"id="aer"></p>
        <p style="color:white"id="ter"></p>
        <p style="color:white"id="titler"></p>
        </form>
        </form>
        </div>
    </body>
</html>
