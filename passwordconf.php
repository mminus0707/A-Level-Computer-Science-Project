<?php

session_start();
require_once('Userclass.php');
$mysqli = new mysqli("localhost","root","","user");

$pword=$_POST["password_confirm"];
$pwordhash = sha1($pword);
$valid = "Make sure that your password is at least 6 characters";
if(isset($_SESSION["email"])){
$email = $_SESSION["email"];
}

if($pword!="" && strlen($pword) > 6){
    if ($mysqli->connect_errno){ // make sure that there isnt a connection error
        header("Location:index.html");
    }else{
        $sql = "SELECT * FROM `user_details` WHERE `Email`='$email' and `Password`='$pwordhash'";
        $res=$mysqli->query($sql); // run the sql and save it as res

        if ($res -> num_rows==1){ // if there is 1 result go to homepage else go back to index page
            header("location: newpassword.php");
            
        }else{
            $_SESSION["error"] = "Wrong Password";
            header("location: changepassword.php");
        }
    }
}else{
    $_SESSION["error"] = $valid;
    header("location: changepassword.php");
}
?>