<!DOCTYPE html>
<html>
<head>
	<title>Student Dashboard</title>
	<link rel="stylesheet" href="styles.css">
</head>
<div class="body-div">
<body>

<?php
// Start output buffering and initialize a session
ob_start();
session_start();

?>
<a  id="rlink" href="logout.php">Logout</a>
<h1>Welcome Student!</h1>

<a class="link" href="take_exam.php">Take an exam</a>
<a class="link" href="student_detail.php">See past exam details</a>

</body>
</div>
</html>

