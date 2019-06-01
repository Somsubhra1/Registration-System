<!DOCTYPE html>

<?php

require "config.php";

session_start();

if (isset($_SESSION['login-status']) == false) {
    header("Location:login.php");
    echo "Wrong username or password";
}

?>

<?php

if (isset($_POST['submit'])) {
    move_uploaded_file($_FILES['file']['tmp_name'], "pictures/" . $_FILES['file']['name']);
    $sql = $conn->query("UPDATE users SET picture = '" . $_FILES['file']['name'] . "' WHERE uname = '" . $_SESSION['uname'] . "'");
    $_SESSION['picture'] = $_FILES['file']['name'];

}

?>

<?php

if ($_SESSION['picture'] == "") {
    echo "<img src='pictures/bot.png' height='100' width='100' alt='default profile pic'>";
} else {
    echo "<img src='pictures/" . $_SESSION['picture'] . "' height='100' width='100' alt='profile pic'>";
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php echo "<h2>", $_SESSION['name'], "</h2>" ?> <br> <br>

<form action="profile.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" value="Submit" name="submit">

</form>
<br>
<br>
<h2>Change password</h2>
<form action="profile.php" method="post">
    <input type="password" name="oldpass" placeholder="Old password">
    <input type="password" name="newpass1" placeholder="New password" >
    <input type="password" name="newpass2" placeholder="New password again">
    <input type="submit" name="psubmit" value="Change Password">
</form>
<br><br>

<?php

// require 'config.php';

if (isset($_POST['psubmit'])) {
    // var_dump($_SESSION);
    $oldpass = $conn->real_escape_string($_POST['oldpass']);
    $newpass1 = $conn->real_escape_string($_POST['newpass1']);
    $newpass2 = $conn->real_escape_string($_POST['newpass2']);
    $uname = $_SESSION['uname'];

    $oldpass = md5($oldpass);
    $sql = $conn->query("SELECT * FROM users WHERE uname = '$uname' AND password = '$oldpass';");
    $count = $sql->num_rows;
    $row = $sql->fetch_assoc();
    if ($count > 0) {
        if ($newpass1 == $newpass2) {
            $newpass1 = md5($newpass1);
            $sql = $conn->query("UPDATE users SET password = '$newpass1' WHERE uname = '$uname';");
            if ($sql) {
                echo "Password updated successfully";
            } else {
                echo "Couldn't update password";
            }
        } else {
            echo "New passwords don't match";
        }
    } else {
        echo "Wrong password";
    }
}

?>
<br><br>

<a href="destroy.php">Logout</a>

</body>
</html>
