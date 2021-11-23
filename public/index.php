<?php
  session_start();

  if(isset($_SESSION["userId"])){
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
</form>

<?php } ?>