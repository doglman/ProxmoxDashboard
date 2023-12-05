<?php session_start(); ?>
<h2>Login</h2>

<form action="../actions/login_action.php" method="post">
  <p>
    <label for="username">Username: </label>
    <input type="text" id="username" name="username" required/>
  </p>
  <p>
    <label for="password">Password: </label>
    <input type="password" id="password" name="password" required/>
  </p>
  <input type="submit" value="submit"/?>
</form>
<p>
  <?php
    echo $_SESSION['loginError'];
    $_SESSION['loginError'] = "";
   ?>
</p>
