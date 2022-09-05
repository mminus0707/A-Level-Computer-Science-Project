<?php

session_start();
require_once('Userclass.php');
$mysqli = new mysqli("localhost","root","","user");

$email=$_POST["email_container"];
$pword=$_POST["password_container"];
$pwordhash=sha1("$pword");
$error = "Email or Password <br> Incorrect";
$valid = "Please make sure that you enter your email and password also length of the password is greater than 6 characters";

if($pword!="" && strlen($pword) > 6 && $email != ""){
    if ($mysqli->connect_errno){ // make sure that there isnt a connection error
        header("Location:index.html");
    }else{
        $sql = "SELECT * FROM `user_details` WHERE `Email`='$email' and `Password`='$pwordhash'";
        $res=$mysqli->query($sql); // run the sql and save it as res

        if ($res -> num_rows==1){ // if there is 1 result go to homepage else go back to index page
            $row = mysqli_fetch_assoc($res);
            $u = new User($row["Name"],$row["Email"],$row["RankID"],$row["UserID"]); 
            $name = $u->getName();
            $rank = $u->getRank();
            $email = $u->getEmail();
            $userid = $u->getID();
            $_SESSION["name"]= $name;
            $_SESSION["rank"]= $rank;
            $_SESSION["email"]= $email;
            $_SESSION["userid"]= $userid;
            $_SESSION['logged_in'] = true;
            header("location: homeli.php");
            
        }else{
            $_SESSION["error"] = $error;
            header("location: index.php");
        }
    }
}else{
    $_SESSION["error"] = $valid;
    header("location: index.php");
}
?>