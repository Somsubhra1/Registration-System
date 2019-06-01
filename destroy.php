<?php

session_start();
session_destroy();
header("Location:login.php"); // after session is destroyed redirect user to login.php page

?>