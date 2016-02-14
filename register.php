<?php 
	require_once("functions.php");
	require_once("db-const.php");
	session_start();
	if (logged_in() == true) {
		redirect_to("profile.php");
	}
?>
<html>
<head>
	<title>User registration form</title>
</head>
<body>	
<h1>User registration form</h1>
<hr />
<!-- The HTML registration form -->
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	Username: <input type="text" name="username" /><br />
	Password: <input type="password" name="password" /><br />
	First name: <input type="text" name="first_name" /><br />
	Last name: <input type="text" name="last_name" /><br />
	Email: <input type="type" name="email" /><br />

	<input type="submit" name="submit" value="Register" />
	<a href="login.php">I already have an account...</a>
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
	# prepare data for insertion
	$username	= $_POST['username'];
	$password	= $_POST['password'];
	$first_name	= $_POST['first_name'];
	$last_name	= $_POST['last_name'];
	$email		= $_POST['email'];

	# check if username and email exist else insert
	// u = username, e = emai, ue = both username and email already exists
	$exists = "";
	$result = $mysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "u";
	}	
	$result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "e";
	}

	if ($exists == "u") echo "<p><b>Error:</b> Username already exists!</p>";
	else if ($exists == "e") echo "<p><b>Error:</b> Email already exists!</p>";
	else if ($exists == "ue") echo "<p><b>Error:</b> Username and Email already exists!</p>";
	else {
		# insert data into mysql database
		$sql = "INSERT  INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `email`) 
				VALUES (NULL, '{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$email}')";

		if ($mysqli->query($sql)) {
			redirect_to("login.php?msg=Registred successfully");
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
	}
}
?>	
<hr />
</body>
</html>