<!DOCTYPE html>
<html>
<head>
	<title>Set Exam</title>
	<link rel="stylesheet" href="styles.css">
</head>
<div class="body-div">
<body>

<?php 

// Start output buffering and initialize a session
ob_start();
session_start();

$user = $_SESSION['username'];

define ('MYSQL', 'includes/mysqli_connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
	
	$question = $_POST['question'];
	
	$options = array();
		
	$options[1] = $_POST['option1'];
	$options[2] = $_POST['option2'];
	$options[3] = $_POST['option3'];
	$options[4] = $_POST['option4'];

	if (isset($_POST['addquestion'])){
	//Get user id
	$query = "select userID from User where (username='$user')";
	$r = mysqli_query ($connection, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($connection));
		
		if (mysqli_affected_rows($connection) > 0) {
			$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
			$userid = $row['userID'];
		}
		
		$query = "INSERT INTO Questions VALUES ('$question', '$options[1]', '$options[2]', $options[3], $options[4])";
		$r = mysqli_query ($connection, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($connection));
		
		//If database has been updated
		if (mysqli_affected_rows($connection) == 1) {
			// Save the values to be used in next pages
				$_SESSION['question'] = $question;
				//$_SESSION['option'] = ;
				
			// Redirect the user
			ob_end_clean(); // Delete the buffer.
			header("Location: set_exam.php");
			exit();
		} else { // If database was not updated
			echo '<p>Please try again.</p>';
		}
		
	} else { // If questions and options were not properly collected
		echo '<p>Please try again.</p>';
	}
	
	mysqli_close($connection);
} 
?>

<div class="exam">
<form action="addquestion.php" method="post">
	<h2><b>Set Exam</b></h2>
	<p><b>Exam title:</b> <input type="text" name="title" required></p>
<?php 

	//Get user id
	$query = "select userID from User where (username='$user')";
	$r = mysqli_query ($connection, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($connection));
		
	if (mysqli_affected_rows($connection) > 0) {
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
		$userid = $row['userID'];
	}
		
	$q = "select courseName, courseID from Course where (adminID='$userid')";
	$r = mysqli_query ($connection, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
	if (mysqli_affected_rows($connection) > 0) {
		echo '<p><b>Choose a course: </b> <select name="course">';
		while($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)){
			
			echo '<option value=';
			echo $row['courseID'];
			echo ">";
			echo $row['courseName'];
			echo '</option>';
		}
		echo '</select>';
	} else {
		echo '<p>No course found.</p>';
	}
?>

	<p><b>Question:</b> <input type="text" name="question" required></p>

	<p><b>Option 1:</b> <input type="text" name="option1" required></p>
	<p><b>Option 2:</b> <input type="text" name="option2" required></p>
	<p><b>Option 3:</b> <input type="text" name="option3" required></p>
	<p><b>Option 4:</b> <input type="text" name="option4" required></p>
	<p><b>Answer:</b> <input type="text" name="correct" required></p>
	<input class="submit" type="button" name="addquestion" value="Add another question" >
	<input class="submit" type="submit" name="submit" value="Submit Questions" >
</form>
</div>

</body>
</div>
</html>
