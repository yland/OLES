<?php 

// Start output buffering and initialize a session
ob_start();
session_start();

define ('MYSQL', 'includes/mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	$username = $_POST['username'];
	$password = $_POST['password'];
	//$type = $_SESSION['usertype'];
	
	//if ($username && $password && $type) {
	if (isset($_POST['submit'])) {
		// Query the database
		$query = "SELECT username, password FROM User WHERE (username='$username' AND password=SHA1('$password'))";		
		$r = mysqli_query ($connection, $query) or trigger_error("Query: $query\n<br />MySQL Error: " . mysqli_error($connection));
		
		//If user is found
		if (@mysqli_num_rows($r) == 1) {
			// Save the values to be used in next pages
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
			mysqli_close($connection);
	
			// Redirect the user
			ob_end_clean(); // Delete the buffer.
			if ($_SESSION['usertype'] === 'admin') {
              	header("Location: admin_dashboard.php");
          	}else if($_SESSION['usertype'] === 'student') {
            	header("Location: student_dashboard.php");
             }	
			exit();
				
		} else { // User details not found in database
			echo '<p>Username or password incorrect.</p>';
		}
		
	} else { // If something else went wrong.
		echo '<p>Please try again. Something is wrong!</p>';
	}
	
	mysqli_close($connection);
} 
?>

<ul>
  <li><a href="registration.php">Register</a></li>
</ul> 

<h1>Login</h1>
<form action="login.php" method="post">
	<p><b>Username:</b> <input type="text" name="username" required></p>
	<p><b>Password:</b> <input type="password" name="password" required></p>
	<input type="submit" name="submit" value="Login" >
</form>
