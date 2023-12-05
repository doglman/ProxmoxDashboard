<?php session_start(); ?>
<h2>Register</h2>

<!-- contains a form to register a new user -->
<form action="../actions/register_action.php" method="post">
  <p>
    <label for="username">Username: </label>
    <input type="text" id="username" name="username" required/>
  </p>
  <p>
    <label for="password">Password: </label>
    <input type="password" id="password" name="password" required/>
  </p>
  <p>
    <label for="password2">Confirm Password: </label>
    <input type="password" id="password2" name="confirmPassword" required/>
  </p>
  <input type="submit" value="submit"/>
</form>
<p>
  <?php echo $_SESSION['registrationError']; ?>
</p>
