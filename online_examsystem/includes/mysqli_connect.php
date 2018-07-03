<?php
$servername = "localhost";
$username = "root";
$password = "useryolande";
$dbname = "exam_db";

// Create connection to database
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
echo "Connected successfully to database";
?>

