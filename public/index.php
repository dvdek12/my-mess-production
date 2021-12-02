<?php
    session_start();
    ob_start();
?>

<title>MyMess</title>
<head><script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2320255945489240"
     crossorigin="anonymous"></script></head>

<?php

  if(isset($_SESSION["userId"])){ //check if logged in
    header("location: mymess.php");
  }
  else
  {
  ?>

<link rel="stylesheet" href="loginStyle.css">
<form class="login" action="../private/login.php" method="POST">
  <input type="text" name="login" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <button type="submit">Login</button>
  <a onclick="register()" >Register</a>
</form>

<form class="register" id="register" action="../private/register.php" method="POST">
  <input type="text" name="login" placeholder="Username">
  <input type="password" name="password" placeholder="Password">
  <input type="password" name="rePassword" placeholder="Repeat Password">
  <button type="submit">Register</button>
</form>

<script>
document.getElementById("register").style.display = "none";

function register(){ //showing register panel
  document.getElementById("register").style.display = "block";
}

<?php if(isset($_SESSION["error"])){ ?> //errors
  alert( <?php echo '"'.$_SESSION["error"].'"'; 
          unset($_SESSION["error"]);         ?>  );
<?php } ?>

</script>

<?php } ob_end_flush(); ?>