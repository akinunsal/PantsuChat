    <?php 
	require_once("functions.php");
	require_once("db-const.php");
	session_start();
	if (logged_in() == true) {
		redirect_to("profile.php");
	}
    // ALREADY EXPLAINED THIS OVER IN INDEX.PHP
    $bg = array('/PantsuStyle/logo/pant-1.png', '/PantsuStyle/logo/pant-2.png', '/PantsuStyle/logo/pant-3.png', '/PantsuStyle/logo/pant-4.png', '/PantsuStyle/logo/pant-5.png','/PantsuStyle/logo/pant-6.png', '/PantsuStyle/logo/pant-7.png', );

    $i = rand(0, count($bg)-1);
    $selectedBg = "$bg[$i]";
?>
<html>
<head>
	<title>User Login Form - pantsu!chat</title>
    <link rel='stylesheet prefetch' href='https://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.css'>
    <link rel="stylesheet" href="style-login.css">
</head>
<body>
<main>
<div id="overlay"></div>
    <ul id="scene">
        <li class="layer" data-depth="0.1">
            <div class="layer1"></div>
        </li>
        <li class="layer" data-depth="0.2">
            <div class="layer2"></div>
        </li>
    </ul>
            <div class="wrapper">
                <img class="displayed" src="<?php echo $selectedBg; ?>" alt="Pantsu!">
                <img class="displayed" src=/PantsuStyle/logo/Citation.png>
                <div class="col-sm-12 col-md-10 col-md-offset-1">
                <hr />
                    
                <!-- HTML FORM START -->
                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" type="text" name='username' placeholder="username"/>          
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input class="form-control" type="password" name='password' placeholder="password"/>     
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Remember me until i log out
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-def btn-block" value="submit">Login</button>
                    </div>
                    <div class="form-group text-center">
                        <a href="forgot.php">Forgot Password</a>&nbsp;|&nbsp;<a href="register.php">Support</a>  
                    </div>
            
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
            </form>
        </div>
    </div>
</main>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js'></script>
<script src='http://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'></script> <!-- TODO: MAKE IT LOCAL -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/parallax/1.1.1/jquery.parallax.min.js'></script>
<script src="js/login.js"></script>
</html>
