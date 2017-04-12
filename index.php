<?php
    // First we execute our common code to connection to the database and start the session 
   // require("common.php"); 

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
</script>
        </br></br></br></br></br>
        <img class="displayed" src="<?php echo $selectedBg; ?>" alt="Pantsu!">
        <img class="displayed" src=/PantsuStyle/logo/Citation.png>
        <div id="content">
            <div class=content-right><a href="register.php"><img class="signup" src=signup.png></a><a href="login.php"><img class="login" src=login.png></a>
        </div>
    </div>
</body>