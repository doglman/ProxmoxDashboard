<?php
error_reporting(-1);
session_start();

if (!array_key_exists('logged_in', $_SESSION)) {
  header('Location: ./views/login.php');
  die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Proxmox Dashboard</title>
  <!-- Links to stylesheets -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <nav>
      <a href="views/manage.php">Manage Datacenter</a> | <a href="actions/logout_action.php"> LOGOUT </a>
  </nav>
  <h1>Datacenter Dashboard</h1>
  <p> -- insert Graphana dashboard here -- </p>

</body>

</html>
