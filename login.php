<!DOCTYPE html>
<?php

include 'config.php'; // importing db config file

if(isset($_POST['submit'])) {
    $uname = $conn->real_escape_string($_POST['uname']);
    $pass = $conn->real_escape_string($_POST['pass']);

    $pass = md5($pass); // converting entered password to md5 format

    // querying to db
    $sql = $conn->query("SELECT * FROM users WHERE uname = '$uname' AND password = '$pass';"); // vulnerable to sql injections. need fix in upcoming versions

    $count = $sql->num_rows;
    $row = $sql->fetch_assoc();  // fetching the query reply

    if ($count > 0) {
        // starting session and setting session vars
        session_start();
        $_SESSION['login-status'] = true;
        $_SESSION['uname'] = $uname;
        $_SESSION['name'] = $row['name'];
        $_SESSION['lname'] = $row['lname'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['picture'] = $row['picture'];

        // redirecting user to profile page
        header("Location:profile.php");
    } else {
        echo "User not present. Please register first.";

        // refreshing the page
        header("Location:login.php");
    }
}
?>




<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="login.php" method="post" role="form">
        <h2>Please login here:</h2>
        <input type="text" name="uname" autofocus="" placeholder="Username" > <br>
        <input type="password" name="pass" autofocus="" placeholder="Password" > <br>
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        <br>

        <input type="submit" value="Login" name="submit">
    
    </form> 
    <br>
    <a href="register.php">Sign up</a>
</body>
</html>