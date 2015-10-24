<?php
    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 

  $bg = array('pant-01.png', 'pant-02.png', 'pant-03.png', 'pant-04.png', 'pant-05.png','pant-06.png', 'pant-07.png', ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen

?>


<head>
<link rel="stylesheet" type="text/css" href="style-index.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="easy.notification.js"></script>
<script type="text/javascript" src="notification.js"></script>
<script type="text/javascript">
	$(function(){		   
		$.easyNotification();	
	});
</script>
</head>
<body>

<pre>
<?php
    if(empty($_SESSION['user']))  {
?>
<p>Hello, please <a href="http://pantsuchat.tk/login.php">login</a></p>
<?php
    } else {
    ?>
<p>Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>! <a href="http://pantsuchat.tk/private.php">click here</a> to proceed into the private area.</p>
<?php
}
?>
</pre>
</br></br></br></br></br>
<img class="displayed" src="<?php echo $selectedBg; ?>" alt="Pantsu!">
<img class="displayed" src=motto.png>
<a href="http://pantsuchat.tk/register.php"><img class="signup" src=signup.png></a><a href="http://pantsuchat.tk/login.php"><img class="login" src=login.png></a>
</body>