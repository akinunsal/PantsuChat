<?php 
	require_once("functions.php");
	require_once("db-const.php");
	session_start();
	if (logged_in() == true) {
		redirect_to("profile.php");
	}

    $bg = array('/PantsuStyle/logo/pant-1.png', '/PantsuStyle/logo/pant-2.png', '/PantsuStyle/logo/pant-3.png', '/PantsuStyle/logo/pant-4.png', '/PantsuStyle/logo/pant-5.png','/PantsuStyle/logo/pant-6.png', '/PantsuStyle/logo/pant-7.png', ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen


?>
<html>
<head>
	<title>User registration form</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="style-register.css">
</head>
<body>
    <div id="horizontal-scroll">
    <img class="displayed" src="<?php echo $selectedBg; ?>" alt="Pantsu!">
    <img class="displayed" src=/PantsuStyle/logo/Citation.png>
    <hr />
<!-- The HTML registration form -->
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
	Username: <input type="text" name="username" /><br />
	Password: <input type="password" name="password" /><br />
	First name: <input type="text" name="first_name" /><br />
	Last name: <input type="text" name="last_name" /><br />
	Email: <input type="type" name="email" /><br />
    <input type="checkbox" name="skip" value="skipped">I agree i am of legal age to view the content for this site. <br />

	<!-- <input type="submit" name="submit" value="Register" /> -->
    <input type="image" src='/PantsuStyle/mouseoutbutton.png' width='322' height='133' type="submit" name="submit" value="Register" onmouseover="this.src='/PantsuStyle/mouseoverglow.png';" onmouseout="this.src='/PantsuStyle/mouseoutbutton.png';" /><br />
	<a href="login.php">B-But I already have an account... (&#8807;&#65103;&#8806;&#10047;)</a>
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
    </div>
</body>
    
</html>