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
<?
function getExtension($str) {$i=strrpos($str,".");if(!$i){return"";}$l=strlen($str)-$i;$ext=substr($str,$i+1,$l);return $ext;}
$formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
 $name = $_FILES['file']['name'];
 $size = $_FILES['file']['size'];
 $tmp  = $_FILES['file']['tmp_name'];
 if(strlen($name)){
  $ext = getExtension($name);
  if(in_array($ext,$formats)){
   if($size<(5136*5136)){
    $imgn = time().".".$ext;
    if(move_uploaded_file($tmp, "./desu/".$imgn)){
     echo "File Name : ".$_FILES['file']['name'];
     echo "<br/>File Temporary Location : ".$_FILES['file']['tmp_name'];
     echo "<br/>File Size : ".$_FILES['file']['size'];
     echo "<br/>File Type : ".$_FILES['file']['type'];
     echo "<br/>Image : <img style='margin-left:10px;' src='desu/".$imgn."'>";
    }else{
     echo "Uploading Failed. Please wait up to 5 minutes and try again.";
    }
   }else{
    echo "The maximum upload size is 1MB.";
   }
  }else{
   echo "Invalid file format. Uplodad in .jpg, .png, .gif, .bmp or .jpeg";
  }
 }else{
  echo "Please select an image.";
  exit;
 }
}
?>
<html>
 <head>
  <script src="//code.jquery.com/jquery-latest.min.js"></script>
  <script src="http://malsup.github.io/jquery.form.js"></script>
 </head>
 <body>
  <form action="upload.php" method="POST" id="uploadform">
   <input type="file" name="file"/>
   <input type="submit" value="Upload"/><br/><br/>
   Message :
   <div id="onsuccessmsg" style="border:5px solid #CCC;padding:15px;"></div>
  </form>
 </body>
</html>

<script>
$(document).ready(function(){
 function onsuccess(response,status){
  $("#onsuccessmsg").html("Status :<b>"+status+'</b><br><br>Response Data :<div id="msg" style="border:5px solid #CCC;padding:15px;">'+response+'</div>');
 }
 $("#uploadform").on('submit',function(){
  var options={
   url     : $(this).attr("action"),
   success : onsuccess
  };
  $(this).ajaxSubmit(options);
 return false;
 });
});
</script>