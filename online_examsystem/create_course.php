<!DOCTYPE html>
<html>
<head>
	<title>Create course</title>
	<link rel="stylesheet" href="styles.css">
</head>
<div class="body-div">
<body>

<a id="rlink" href="logout.php">Logout</a>


<?php
// Start output buffering and initialize a session
ob_start();
session_start();

$user = $_SESSION['username'];

define ('MYSQL', 'includes/mysqli_connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	$course = $_POST['course'];
	$coursecode = $_POST['coursecode'];	
	

	if ($course && $coursecode) {
		//Get user id
		$query = "select userID from User where (username='$user')";
		$r = mysqli_query ($connection, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($connection));
		
		if (mysqli_affected_rows($connection) > 0) {
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
			$userid = $row['userID'];
		}
		
		$query = "INSERT INTO Course (courseName, courseCode, adminID) VALUES ('$course', '$coursecode', '$userid')";
		$r = mysqli_query ($connection, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($connection));
		
		//If database has been updated
		if (mysqli_affected_rows($connection) == 1) {
			// Save the values to be used in next pages
				$_SESSION['course'] = $course;
				$_SESSION['coursecode'] = $coursecode;
				
			// Redirect the user
			ob_end_clean(); // Delete the buffer.
			header("Location: admin_dashboard.php");
			exit();
		} else { // If database was not updated
			echo '<p>Please try again.</p>';
		}
		
	} else { // If title or course was not properly collected
		echo '<p>Please try again.</p>';
	}

	mysqli_close($connection);

}
?>


<div class="course">
<h2>Create a course</h2>
<form action="create_course.php" method="post">
	<p><b>Course Title:</b> <input type="text" name="course" required></p>
	<p><b>Course Code:</b> <input type="text" name="coursecode" required></p>
	
	<input class="submit" type="submit" name="submit" value="Save" >
	
</form>
</div>
<a id="rlink" href="admin_dashboard.php">Back</a>
</body>
</div>
</html>
