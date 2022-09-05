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
        <title>Social</title>
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
                <!-- NAVBAR --> 
                <a class="button" href="Logout.php" style="text-decoration: none"> Log out </a>
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="shop.php" style="text-decoration: none"> Shop </a>
                <hr>     
            </div>

        </div>
        <form method="post" action="socialsearch.php">
            <input type="text" name="UsernameSearch" id="UsernameSearch"> <input type="submit" value="Search">
        </form>

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

$sql = "SELECT * FROM `user_details` ORDER BY `Name` ASC";
$result=$mysqli->query($sql);
//create table for all users
echo "<table border='1' bordercolor=white style='color:white;'>
<caption> All Users </caption>
<tr>
<th>ID</th>
<th>Username</th>

</tr>";
//enter each user
while ( $row = mysqli_fetch_assoc( $result )){?>
    <tr>
    <form action="">
      <td name="userid"><?=$row['UserID']?></td>
      <td id="name" name="name"><?=$row['Name']?></td>
</form>
    </tr>
<?php
}

echo "</table>";
?>
    </body>
</html>
