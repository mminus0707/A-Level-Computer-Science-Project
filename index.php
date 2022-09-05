<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Log In Soft G</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script>
        function validation() {
        var y = document.getElementById("email_container").value.length;
        var x = document.getElementById("password_container").value.length;
        if (x == 0 || x < 6){ 
          document.getElementById("password_container").style.border="2px solid red";          
          document.getElementById("password_container").placeholder="Enter your password";
        }if (y == 0) { 
          document.getElementById("email_container").style.border="2px solid red";        
          document.getElementById("email_container").placeholder="Enter your email";
        }if(y != 0 && x > 6){   
            document.getElementById("Loginform").submit(); 
        }
      }
        </script>
    </head>
    <body>
        <div class="header">
            <!-- NAVBAR --> 
            <div>
                <a class="button" href="signup.php" style="text-decoration: none"> Sign Up </a>
                <a class="button" href="home.html" style="text-decoration: none"> Home </a>
                <hr>
            </div>
        </div>
        <!-- LOGIN FORM --> 
        <div id="container" >
            <div id="Login">
                <form id="Loginform" action="Loginprocess.php" method="post">
                    <pre style="color:white;"> Hello, Please Login </pre>
                    <header name="error"></header>
                    <label style="color:white;"> Email </label> <br>
                    <input class="input"type="email" name="email_container" id="email_container"> <br>
                    <label style="color:white;"> Password </label> <br>
                    <input class="input" type="password" name="password_container" id="password_container" placeholder="Password"> <br>
                    <input onclick="validation()" type="button" class="button" style="margin-top:3%" value="Submit">
                    <br>
                    <label style="color:white;font-family: Courier New;">
                    <?php
                        if(isset($_SESSION["error"])){
                            $error = $_SESSION["error"];
                            echo "<span>$error</span>";
                        }
                    ?>
                    </label>
                    <pre style="color:white;"> New around here? </pre>
                    <a class="button" href="signup.php" style="text-decoration: none"> Create an Account </a>
                </form>
            </div>   

    </tr>
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

$sql2 = "SELECT * FROM `points` ORDER BY `SPoints` DESC";
$result2=$mysqli->query($sql2);
// table created for the spoint leaderboard
echo "<table border='1' bordercolor=white style='color:white;display: inline-block; margin-left:250px; margin-top:-400px;'>
<caption> SPoint Leaderboard </caption>
<tr>
<th>ID</th>
<th>Username</th>
<th>SPoint</th>
</tr>";

$i = 0;
//enters the top five users with this loop
while ( $row2 = mysqli_fetch_assoc( $result2 ) and $i < 5){
    $id = $row2['UserID'];
    $sqluname = "SELECT * FROM `user_details` WHERE `UserID` = $id";
    $resultname=$mysqli->query($sqluname);
    $resname = mysqli_fetch_assoc($resultname)?>
    <tr>
    <form action="">
      <td><?=$row2['UserID']?></td>
      <td><?=$resname['Name']?></td>
      <td><?=$row2['SPoints']?></td>
</form>
    </tr>
<?php
$i += 1;
}
//closing the table
echo "</table>";
?>       
        </div>
    </body>
</html>

<?php
    unset($_SESSION["error"]);
?>