<?php
// Start output buffering and initialize a session
ob_start();
session_start();

echo '<h1>Welcome ';
echo  $_SESSION['username'] ;
echo  $_SESSION['usertype'] ;
echo ', You are a student!</h1>';

?>
<li><a href="registration.php">Register</a></li>
<li><a href="login.php">login</a></li>

