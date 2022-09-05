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
        <title>Add item</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
        function validation(){
        var y = document.getElementById("points").value;
        var x = document.getElementById("spoints").value;
        var z = document.getElementById("title").value;
        // if value is less than 100
        if(y < 100){
            document.getElementById("aer").innerHTML="At least 100 points";
        }
        // if spoint value is in negative
        if(x < 0){
            document.getElementById("aer2").innerHTML="Can not have negative SPoints";
        }
        // if title is empty
        if(z == ""){
            document.getElementById("ter").innerHTML="Enter your Title";
        }
        // if title length is greater than 32
        if(z.length > 32){
            document.getElementById("ter").innerHTML="Length of your title can not be greater than 72 characters";
        }
        // otherwise
        if(y != "" && x != "" && x > -1 && y > 99){
            document.getElementById("itemform").submit(); 
        }
        }
        </script>
    </head>
    <body>
        <?php
        // if the session for rank and email is set use them as local variables
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
            <form action="additemprocess.php" method="post" id="itemform"> 
            <!--Name of item-->
            <label style="color:white;"> Item</label><br>
            <input type="text" id="title" name="title"> <br>            
            <!-- Point requirements -->    
            <label style="color:white;"> Points</label><br> 
            <input type="number" id="points" name="points" min="100" max="5000"><br>
            <!-- SPoint requirements -->
            <label style="color:white;"> SPoints</label><br>
            <input type="number" id="spoints" name="spoints" min="100" max="5000"><br>
            <!--Button to submit-->
            <input onclick="validation()" type="button" class="button" style="margin-top:3%" value="Submit">
            <!--Error paragraphs -->
            <p style="color:white"id="ter"></p></br>
            <p style="color:white"id="aer"></p>
            <p style="color:white"id="aer2"></p>
            </form>
        </div>

    </body>
</html>
