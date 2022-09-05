<?php
session_start();
?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sign Up</title>
        <meta name="Test" content="Test">
        <link rel="stylesheet" href="main.css">
        <script> 
        function validation() {
        var y = document.getElementById("email_container").value;
        var x = document.getElementById("password_container").value;
        var z = document.getElementById("password_conf").value;
        var a = document.getElementById("email_conf").value;
        var u = document.getElementById("username_container").value;
            // if the password is shorter than 6 characers
        if (x.length < 6){ 
          document.getElementById("password_container").style.border="2px solid red";          
          document.getElementById("password_container").placeholder="Enter your password";
          document.getElementById("per2").innerHTML="Password has to be at least 6 characters";
        }// if the email is empty
        if (y.length == 0) { 
          document.getElementById("email_container").style.border="2px solid red";        
          document.getElementById("email_container").placeholder="Enter your email";
        }//if the password and confirmation dont match
        if(x != z){
            document.getElementById("password_container").style.border="2px solid red";          
            document.getElementById("per").innerHTML="Password do not Match";
            document.getElementById("password_conf").style.border="2px solid red";          
        }// if email and confirmation dont match
        if(y != a){
            document.getElementById("email_container").style.border="2px solid red";        
            document.getElementById("eer").innerHTML="Emails do not Match";
            document.getElementById("email_conf").style.border="2px solid red"; 
        }// if the username is empty
        if (u.length < 6){ 
          document.getElementById("username_container").style.border="2px solid red";          
          document.getElementById("uer").innerHTML="Username has to be at least 6 characters";
        }if(y.length != 0 && x.length > 5 && x == z && y == a && u.length > 5){ 
            document.getElementById("email_conf").style.border="";
            document.getElementById("email_container").style.border="";
            document.getElementById("password_conf").style.border="";
            document.getElementById("password_container").style.border="";
            document.getElementById("username_container").style.border="";
            document.getElementById("Signupform").submit(); 
        }
      }
        </script>
    </head>
    <body>
        <div class="header">
            <div>
                <a class="button" href="index.php" style="text-decoration: none"> Log In </a>
                <a class="button" href="home.html" style="text-decoration: none"> Home </a>    
                <hr>
            </div>
        </div>
        <div id="container" >
            
            <div id="Login">
                <form id="Signupform" action="Registerationproc.php" method="post">
                    <pre style="color:white;"> Hello, Please Sign Up </pre>
                    <div style="height: 1px;margin-left:40%">
                    </div>
                    <label style="color:white;"> Username </label> <br>
                    <input class="input"type="text" name="username_container" id="username_container" placeholder="At least 6 Characters"> <br>               
                    <label style="color:white;"> Email </label> <br>
                    <input class="input"type="email" name="email_container" id="email_container"> <br>
                    <label style="color:white;"> Confirm Email </label> <br>
                    <input class="input"type="email" id="email_conf" name="email_conf" id="email_conf"> <br>                    
                    <label style="color:white;"> Password </label> <br>
                    <input class="input" type="password" name="password_container" id="password_container" placeholder="At least 6 Characters"> <br>
                    <label style="color:white;"> Confirm Password </label> <br>
                    <input class="input" type="password" id="password_conf" name="password_conf" id="password_conf" > <br>             
                    <input onclick="validation()" type="button" class="button" style="margin-top:3%" value="Create Account">
                    <p style="color:white"id="eer"></p>
                    <p style="color:white"id="per"></p>
                    <p style="color:white"id="per2"></p>
                    <p style="color:white"id="uer"></p>
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
        </div>
    </body>
</html>

<?php
    unset($_SESSION["error"]);
?>