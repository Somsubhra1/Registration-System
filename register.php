<!DOCTYPE html>
<?php

error_reporting(0); // no error reporting on web page
require('config.php');  // including db conf into register page

if (isset($_POST['submit'])) {
    $email1 = $_POST['email1'];
    $email2 = $_POST['email2'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($email1 == $email2) {
        if ($pass1 == $pass2) {
            // checking using filters
            $name = $conn->real_escape_string($_POST['name']);
            $lname = $conn->real_escape_string($_POST['lname']);
            $uname = $conn->real_escape_string($_POST['uname']);
            $email1 = $conn->real_escape_string($email1);
            $email2 = $conn->real_escape_string($email2);
            $pass1 = $conn->real_escape_string($pass1);
            $pass2 = $conn->real_escape_string($pass2);

            // converting password from text format to md5
            $pass1 = md5($pass1);

            // checking if user already exists in db
            $sql = $conn->query("SELECT * FROM `users` WHERE `uname` = '$uname';");
            if ($sql->num_rows > 0) {
                echo "user already exists";  
                exit();          
            }

            // checking if email already exists in db
            $sql = $conn->query("SELECT * FROM `users` WHERE `email` = '$email1';");
            if ($sql->num_rows > 0) {
                echo "Email already exits";
                exit();              
            }

            // inserting new user details to db
            $sql = $conn->query("INSERT INTO `users` (`name`, `lname`, `uname`, `email`, `password`) VALUES ('$name', '$lname', '$uname', '$email1', '$pass1');");

            if (!$sql) {
                echo "Error inserting to database: $conn->error";
                exit();
            }
            
            // echo "Registration success";
            session_start();
            $_SESSION['login-status'] = true;
            $_SESSION['uname'] = $uname;
            $_SESSION['name'] = $name;
            $_SESSION['lname'] = $lname;
            $_SESSION['email'] = $email1;
            $_SESSION['picture'] = '';

            // redirecting user to profile page
            header("Location:profile.php");
        }
    }
}


?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <form action="register.php" method="post" role="form">
        <h2>Registration Form</h2>

        <input type="text" name="name" placeholder="Name" required="" autofocus> <br />
        <input type="text" name="lname" placeholder="Last Name" required="" autofocus> <br />
        <input type="text" name="uname" placeholder="Username" required="" autofocus> <br />
        <input type="email" name="email1" placeholder="Email" required="" autofocus> <br />
        <input type="email" name="email2" placeholder="Confirm Email"> <br />
        <input type="password" name="pass1" placeholder="Password"> <br />
        <input type="password" name="pass2" placeholder="Confirm Password"> <br /> <br />
        
        <input name="submit" type="submit" value="Register">
    
    </form>
    <br>
    <a href="login.php">Login</a>
    
</body>
</html>