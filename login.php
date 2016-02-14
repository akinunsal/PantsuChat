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
	<title>User Login Form - PHP MySQL Login System</title>
</head>
<body>
<h1>User Login Form</h1>
<hr />
<!-- The HTML login form -->
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		Username: <input type="text" name="username" /><br />
		Password: <input type="password" name="password" /><br />
		Remember me: <input type="checkbox" name="remember" /><br />

		<input type="submit" name="submit" value="Login" />
		<a href="forgot.php">Forgot Password?</a>
		<a href="register.php">Register</a>
	</form>
<?php
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// processing remember me option and setting cookie with long expiry date
	if (isset($_POST['remember'])) {	
		session_set_cookie_params('604800'); //one week (value in seconds)
		session_regenerate_id(true);
	} 

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
	
	$sql = "SELECT * from users WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows != 1) {
		echo "<p><b>Error:</b> Invalid username/password combination</p>";
	} else {
		// Authenticated, set session variables
		$user = $result->fetch_array();
		$_SESSION['user_id'] = $user['id'];
		$_SESSION['username'] = $user['username'];
		
		// update status to online
		$timestamp = time();
		$sql = "UPDATE users SET status={$timestamp} WHERE id={$_SESSION['user_id']}";
		$result = $mysqli->query($sql);
		
		redirect_to("profile.php?id={$_SESSION['user_id']}");
		// do stuffs
	}
}

if(isset($_GET['msg'])) {
	echo "<p style='color:red;'>".$_GET['msg']."</p>";
}
?>	
<hr />
</body>
</html>