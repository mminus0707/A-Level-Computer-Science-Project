<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Set Password</title>
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

        </div><!--form which will forward the new password-->
                <form id="newpw" onsubmit="" action="setpassword.php" method="post">
                    <pre style="color:white;"> Enter your new Password </pre>
                    <header name="error"></header>
                    <label style="color:white;"> Password </label> <br>
                    <input class="input" type="password" name="new_password" placeholder="Enter your password"> <br>
                    <label style="color:white;"> Confirm password </label> <br>
                    <input class="input" type="password" name="newpw_confirm"> <br>
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
    </body>
</html>
<?php
    unset($_SESSION["error"]);
?>