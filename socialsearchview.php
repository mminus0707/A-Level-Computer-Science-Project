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
        <title>Search Results</title>
        <script>
        function getid(profileid) {
            document.getElementById("profileid").value = profileid;
            document.getElementById("profileidform").submit();
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
            <div>
                <a class="button" href="Logout.php" style="text-decoration: none"> Log out </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <hr>     
            </div>

        </div>
        <div name="Users">
        <form method="post" action="socialsearch.php">
            <input type="text" name="Search" id="Search"> <input type="submit" value="Search">
        </form>
        <br>
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
//create table for results
if ($_SESSION['SearchResQ'] != "No items were found"){
echo "<table border='1' bordercolor=white style='color:white;'>
<caption> All Users </caption>
<tr>
<th>ID</th>
<th>Username</th>
</tr>";

$sql = $_SESSION['SearchResQ'];

$res = $mysqli->query($sql);
//enter results into the table
while ( $row = mysqli_fetch_assoc( $res ) ){?>
    <tr>
      <td id="UserID" name="UserID"><?=$row['UserID']?></td>
      <td id="Name" name="Name"><?=$row['Name']?></td>
      <td><button onclick="getid(<?=$row['UserID']?>)">Click to View</button></td>
    </tr>
<?php
}

echo "</table>";
} else{
    $message = $_SESSION['SearchRes'];
    echo"<p style='color:white'>$message</p>";
}
?><!--hidden form used to view a user's profile-->
    <form action="profileviewprocess.php" id="profileidform" method="post">
        <input id="profileid" name="profileid" type="hidden" value=""/>
</form> 
    </div>
    </body>
</html>
