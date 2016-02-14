<?php
	require_once("db-const.php");
	require_once("functions.php");
	session_start();
	
	if (logged_in() == true) {		
		## connect mysql server
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			# check connection
			if ($mysqli->connect_errno) {
				echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
				exit();
			}
		
		$timestamp = time();
		$sql = "UPDATE users SET status = '{$timestamp}' WHERE id ={$_SESSION['user_id']}";
		$result = $mysqli->query($sql);
	}	
?>