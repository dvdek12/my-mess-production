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

function register(){
  document.getElementById("register").style.display = "block";
}

<?php if(isset($_SESSION["error"])){ ?>
  alert( <?php echo '"'.$_SESSION["error"].'"'; 
          unset($_SESSION["error"]);         ?>  );
<?php } ?>

</script>

<?php } ?>