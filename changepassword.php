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
        <title>Change Password</title>
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
                <a class="button" href="profile.php" style="text-decoration: none"> Profile </a>
                <a class="button" href="quizes.php" style="text-decoration: none"> Tests </a>
                <a class="button" href="questions_home.php" style="text-decoration: none"> Questions </a>
                <a class="button" href="homeli.php" style="text-decoration: none"> Home </a>
                <hr>     
            </div>
            <!-- Form where the user will be required to confirm their identity-->
                <form id="pwconfform" onsubmit="" action="passwordconf.php" method="post">
                    <pre style="color:white;"> Please confirm your Password </pre>
                    <header name="error"></header>
                    <label style="color:white;"> Password </label> <br>
                    <input class="input" type="password" name="password_confirm" placeholder="Enter your password"> <br>
                    <input id="submit" type="submit" class="button" style="margin-top:3%">
                    <br>
                    <label style="color:white;font-family: Courier New;">
                    <?php
                        if(isset($_SESSION["error"])){
                            $error = $_SESSION["error"];
                            echo "<span>$error</span>";
                        }
                    ?>
                    </label>
                </form>
        </div>

    </body>
</html>
<?php
    unset($_SESSION["error"]);
?>