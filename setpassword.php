<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";
$mysqli = new mysqli("localhost","root","","user");
if(isset($_SESSION["email"])){
$email = $_SESSION["email"];
}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}// values are defined here
$error="Please make sure that passwords are matching and over 6 characters";
$pword=$_POST['new_password'];
$pwordhash=sha1("$pword");
$pwordc=$_POST['newpw_confirm'];
$sql = "UPDATE `user_details` SET `Password`='$pwordhash' WHERE `Email`='$email'";

// serverside validation if all of the connditions are met establish connection
if(strlen($pword) > 6 && $pword == $pwordc){
    if ($conn->query($sql) === TRUE){// run the sql code
        header("location: profile.php");
} else{ // if there is a connection error return error
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else{// if conditions are not met display error message
            $_SESSION["error"] = $error;
            header("location: newpassword.php");
        }
$conn->close();

?>