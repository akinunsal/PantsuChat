<?php
	session_start();
	require_once("functions.php");
	require_once("db-const.php");
	
	if (logged_in() == true) {
		redirect_to("profile.php");
	}
?>
<html>
<head>
	<title>Forgot your Username or Password?</title>
</head>
<body>	
<h1>Forgot your Username or Password?</h1>
<hr />
	<p>Please enter your email address below.</p>
	<form action="forgot.php" method="post">
		Email: <input type="text" name="email" />
		<input type="submit" name="submit" value="Submit" />
	</form>
	<?php
	
		if (isset($_POST['submit'])) {
			## connect mysql server
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				# check connection
				if ($mysqli->connect_errno) {
					echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
					exit();
				}
			## query database
				# fetch data from mysql database
				$sql = "SELECT email FROM users WHERE email LIKE '{$_POST['email']}' LIMIT 1";

				if ($result = $mysqli->query($sql)) {
					$user = $result->fetch_array();
				} else {
					echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
					exit();
				}
				
			if ($result->num_rows == 1) {
				// email login cresendials to the user's email
				echo "<p>Login credentials has been sent to <b>{$_POST['email']}</b></p>";
			} else {
				echo "<p>Sorry, no user found with this email.</p>";
			}
		}
	?>
	<a href="login.php">Login</a> | <a href="register.php">Register</a>
<hr />
</body>
</html>