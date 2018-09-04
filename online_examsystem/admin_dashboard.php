<?php
// Start output buffering and initialize a session
ob_start();
session_start();

$user = $_SESSION['username'];

define ('MYSQL', 'includes/mysqli_connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Dashboard</title>
	<link rel="stylesheet" href="styles.css">
</head>
<div class="body-div">
<body>

<a  id="rlink" href="logout.php">Logout</a>
<h1>Welcome Admin!</h1>

<a class="link" href="create_course.php">Create a course</a><br>
<a class="link" href="set_exam.php">Set an exam</a><br>
<a class="link" href="">See past exams you set</a><br>
<a class="link" href="">See students record</a><br>

</body>
</div>
</html>
