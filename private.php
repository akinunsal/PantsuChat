<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // At the top of the page we check to see whether the user is logged in or not 
    if(empty($_SESSION['user'])) 
    { 
        // If they are not, we redirect them to the login page. 
        header("Location: login.php"); 
         
        // Remember that this die statement is absolutely critical.  Without it, 
        // people can view your members-only content without logging in. 
        die("Redirecting to login.php"); 
    } 
     
    // Everything below this point in the file is secured by the login system 
     
    // We can display the user's username to them by reading it from the session array.  Remember that because 
    // a username is user submitted content we must use htmlentities on it before displaying it to the user. 
?> 
<script>
function alertAndRedirect(text) {
    alert(text);
}
</script>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
</head>

<ul class="navigation">
    <li class="nav-item"><a href="index.php">Home</a></li>
    <li class="nav-item"><a href="#" onclick=alertAndRedirect("Coming soon!")>Profile</a></li>
    <li class="nav-item"><a href="#" onclick=alertAndRedirect("Coming soon!")>Chat</a></li>
    <li class="nav-item"><a href="#" onclick=alertAndRedirect("Coming soon!")>Forum</a></li>
    <li class="nav-item"><a href="logout.php">Logout</a></li>
</ul>

<input type="checkbox" id="nav-trigger" class="nav-trigger" />
<label for="nav-trigger"></label>

<div class="site-wrap">
    <div class="site-container">
        <p>Hello <?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>, secret content!<br /></p>
        <a href="memberlist.php">Memberlist</a><br /> 
        <a href="edit_osuname.php">Edit osu! Username</a><br />
        <a href="edit_account.php">Edit Account</a><br /> 
        <a href="logout.php">Logout</a>
        <script type="text/javascript" src="http://discord.deliriousdrunkards.com/discord.min.js"></script>
<script type="text/javascript">
  discordWidget.init({
    serverId: '114367543354982400',
    title: 'DesDesPoi',
    join: true,
    alphabetical: false,
    theme: 'dark',
    hideChannels: ['Total War: Atilla', 'Terraria', 'BnS'],
    showAllUsers: true,
    allUsersDefaultState: true
  });
  discordWidget.render();
</script>

<div class="discord-widget"></div>
    </div>  
</div>