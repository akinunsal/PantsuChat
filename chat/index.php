<?php
    
    /* 
    probably a stupid idea but i didnt set document_root for login.php since
    it's in the same folder as this file. watch out for this if you're stealing
    my code, which by the way you shouldn't do since it's mean and unfair,
    it might be bad but i worked hours on it ;_;
    */
    include($_SERVER['DOCUMENT_ROOT'].'/common.php');
    include("login.php");

?>
<!DOCTYPE html>
<html>
 <head>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="chat.js"></script>
  <link href="chat.css" rel="stylesheet"/>
  <title>PHP Group Chat Test With jQuery & AJAX</title>
 </head>
 <body>
  <div id="content" style="margin-top:10px;height:100%;">
   <center><h1>Pantsu Group Chat</h1></center>
   <div class="chat">
    <div class="users">
     <?
    include("users.php");
        ?>
    </div>
    <div class="chatbox">
     <?
     if(isset($_SESSION['user'])){
      include("chatbox.php");
     }else{
      $display_case=true;
      include("login.php");
     }
     ?>
    </div>
   </div>
  </div>
 </body>
</html> 