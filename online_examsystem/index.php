<?php 

// Start output buffering and initialize a session
ob_start();
session_start();

define ('MYSQL', 'includes/mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if (isset($_POST['submit'])) {
	
		// Query the database to find the user.
		$query = "SELECT username, password FROM User WHERE (username='$username' AND password=SHA1('$password'))";		
		$r = mysqli_query ($connection, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($connection));
		
		// Query if a user is registered as a student or an administrator.
		$q = "SELECT userID FROM Admin where userID = (SELECT userID FROM User WHERE (username='$username'))";
		$result = mysqli_query($connection, $q);
		
		//If user is found
		if (@mysqli_num_rows($r) == 1) {
		
			// Save the values to be used in next pages
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
			mysqli_close($connection);
	
			// Redirect the user to respective admin or student dashoard.
			
			ob_end_clean(); // Delete the buffer.
			if(mysqli_num_rows($result) == 1) {
              	header("Location: admin_dashboard.php");
          	}else if(mysqli_num_rows($result) == 0) {
            	header("Location: student_dashboard.php");
             }	
			exit();
				
		} else { // User details not found in database.
			echo '<p>Username or password incorrect.</p>';
		}
		
	} else { // If something else went wrong.
		echo '<p>Please try again. Something is wrong!</p>';
	}
	
	mysqli_close($connection);
} 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="styles.css">
</head>
<div class="body-div">
<body>

 <a id="rlink" href="registration.php">Register</a>
 
<div class="login">
<form action="index.php" method="post">
	<h1>Login</h1>
	<p><b>Username:</b> <input type="text" name="username" required></p>
	<p><b>Password:</b> <input type="password" name="password" required></p>
	<input class="submit" type="submit" name="submit" value="Login" >
</form>
</div>

</body>
</div>
</html>
