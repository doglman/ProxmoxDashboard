<!-- This page is where users can "manage resources efficiently, provision and de-provision VMs" -->
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
      <a href="../index.php">Manage Datacenter</a> | <a href="actions/logout_action.php"> LOGOUT </a>
  </nav>
  <h1>Datacenter Management</h1>
  <p> -- Build management buttons here -- </p>
    <ul>
        <li> List available VMs </li>
        <li> Provision a VM </li>
        <li> Deprovision a VM </li>
        <li> Start a VM </li>
        <li> Stop a VM </li>
    </ul>
    <!-- Generate a table listing the already-existing VMs -->
    

</body>

</html>
