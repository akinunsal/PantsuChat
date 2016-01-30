<?php
    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 

  $bg = array('/PantsuStyle/logo/pant-1.png', '/PantsuStyle/logo/pant-2.png', '/PantsuStyle/logo/pant-3.png', '/PantsuStyle/logo/pant-4.png', '/PantsuStyle/logo/pant-5.png','/PantsuStyle/logo/pant-6.png', '/PantsuStyle/logo/pant-7.png', ); // array of filenames

  $i = rand(0, count($bg)-1); // generate random number size of the array
  $selectedBg = "$bg[$i]"; // set variable equal to which random filename was chosen

?>

<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style-index.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
</head>
<body>
<div id="horizontal-scroll">
<!-- fuck this shit code innit
<script type="text/javascript" src="easy.notification.js"></script>
<script type="text/javascript" src="notification.js"></script>
<script type="text/javascript">
	$(function(){		   
		$.easyNotification();	
	});
-->
</script>


<div id="cp_widget_f1c5a7b2-d64c-43ad-8582-cdb1b6712d4e">...</div><script type="text/javascript">
var cpo = []; cpo["_object"] ="cp_widget_f1c5a7b2-d64c-43ad-8582-cdb1b6712d4e"; cpo["_fid"] = "AkAAKAdT1YTj";
var _cpmp = _cpmp || []; _cpmp.push(cpo);
(function() { var cp = document.createElement("script"); cp.type = "text/javascript";
cp.async = true; cp.src = "//www.cincopa.com/media-platform/runtime/libasync.js";
var c = document.getElementsByTagName("script")[0];
c.parentNode.insertBefore(cp, c); })(); </script><noscript>Powered by Cincopa <a href='http://pantsuchat.tk'>for use with PantsuChat</a><span>Desu Music</span></noscript>
    
    
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
</br></br></br></br></br>
<img class="displayed" src="<?php echo $selectedBg; ?>" alt="Pantsu!">
<img class="displayed" src=/PantsuStyle/logo/Citation.png>
<a href="http://pantsuchat.tk/register.php"><img class="signup" src=signup.png></a><a href="http://pantsuchat.tk/login.php"><img class="login" src=login.png></a>
</div>
</body>