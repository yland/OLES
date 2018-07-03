<?php 

ob_start();
session_start();

define ('MYSQL', 'includes/mysqli_connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	$fullname = $_POST['fullname'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$usertype = $_POST['usertype'];	
	
	if (isset($_POST['submit'])) {
		
		// Check if the username already exists
		$query = "SELECT username FROM User WHERE username='$username'";
		$r = mysqli_query ($connection, $query) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($connection));
		
		//If the username does not exist
		if (mysqli_num_rows($r) == 0) {

			$connection->query("INSERT INTO User (fullname, username, password, email) VALUES ('$fullname', '$username', SHA1('$password'), '$email')");
			
			//Get the user id to be inserted into admin and student tables.
			$newuserID = $connection->insert_id;
			
			if ($usertype == 'admin') {
               $connection->query("INSERT INTO Admin (userID) VALUES ('$newuserID')");
           }else if ($usertype == 'student') {
             $connection->query("INSERT INTO Student (userID) VALUES ('$newuserID')"); 
          }		
			
			//If database has been updated
			if (mysqli_affected_rows($connection) == 1) {
				// Save the values to be used in next pages
				$_SESSION['username'] = $username;
				

				// Redirect the user
				ob_end_clean(); // Delete the buffer.
				header("Location: dashboard.php");
				exit();
				
	
			} else { // If database was not updated
				echo '<p>Your registration was unsuccessful. Try again!</p>';
			  }
			
		} else { //If username already exists
			echo '<p>This username already exists.</p>';
		  }
		
	} else { // If username or password was not properly collected
		echo '<p class="error">Please try again.</p>';
	  }

	mysqli_close($connection);

}
?>

<ul>
  <li><a href="login.php">Login</a></li>
</ul> 

<h1>Register</h1>
<form action="registration.php" method="post">
	<p><b>Full Name:</b> <input type="text" name="fullname" required></p>
	<p><b>Username:</b> <input type="text" name="username" required></p>
	<p><b>Password:</b> <input type="password" name="password" required></p>
	<p><b>Email:</b> <input type="email" name="email"></p>
	<input type="radio" name="usertype" value="admin" required> Operate as admin<br>
	<input type="radio" name="usertype" value="student" required> Operate as student<br>
	<input type="submit" name="submit" value="Register"/>
</form>
