<!DOCTYPE html>
<html>
<head>
	<title>Take Exam</title>
	<link rel="stylesheet" href="styles.css">
</head>
<div class="body-div">
<body>

<a href="logout.php">Logout</a>
<?php
// Start output buffering and initialize a session
ob_start();
session_start();

?>

<div class="st-exam">
<form action="take_exam.php" method="post">
	<h1>Take exam</h1>
	<p><b>Course Title:</b> <input type="text" name="course" required></p>
	<p><b>Exam Title:</b> <input type="text" name="exam" required></p>
	
</form>
</div>

</body>
</div>
</html>
