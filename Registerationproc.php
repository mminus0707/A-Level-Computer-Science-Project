<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}// values are defined here
$error="Please make sure to fill every box and also make sure that confirmation boxes match their corresponding values";
$uname=$_POST['username_container'];
$email=$_POST['email_container'];
$pword=$_POST['password_container'];
$pwordhash=sha1("$pword");
$pwordc=$_POST['password_conf'];
$emailc=$_POST['email_conf'];
//sql for inserting
$sql="insert into user_details (Name,Email,Password)
values('$uname','$email','$pwordhash')";
//sql for checking whether is there is already an account
$sqlval="select * from `user_details` WHERE `Email`='$email'";
//checking for username
$sqlnameval="select * from `user_details` WHERE `Name`='$uname'";
$res=$conn->query($sqlval);
$res2=$conn->query($sqlnameval);


// serverside validation if all of the connditions are met establish connection
if ($res -> num_rows ==1){
    $_SESSION["error"] = "An account already exists under the same email";
    header("location: signup.php");
}else{// if the username is not already in use next process, entering the data into the database begins
    if ($res2 -> num_rows ==1){
        $_SESSION["error"] = "Username taken";
        header("location: signup.php");
    }
    else{
        if($email != "" && $pword != "" && $pword == $pwordc && $email == $emailc && strlen($pword) > 6){
            if ($conn->query($sql) === TRUE){// run the sql code
                //after the user is created selects user details
                $sqlid="select * from `user_details` WHERE `Email`='$email' and `Password`='$pwordhash'";
                $resid=$conn->query($sqlid);
                if ($resid -> num_rows==1){
                //creates the user's point
                    $row = mysqli_fetch_assoc($resid);
                    $UserID=$row["UserID"];
                    $sqlpoint="insert into points (UserID) values('$UserID')";
                    if ($conn->query($sqlpoint) === TRUE){
                    header('location:index.php');
                    }
            }

        } 
            else{ // if there is a connection error return error
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else{// if conditions are not met display error message
            $_SESSION["error"] = $error;
            header("location: signup.php");
        }
    }
}
$conn->close();

?>