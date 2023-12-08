<!-- This page is where users can "manage resources efficiently, provision and de-provision VMs" -->
<?php
error_reporting(-1);
session_start();

if (!array_key_exists('logged_in', $_SESSION)) {
  header('Location: ./views/login.php');
  die();
}

// Set up the Proxmox API libraries
require_once '../vendor/autoload.php';
//require __DIR__ . '/vendor/autoload.php';

use ProxmoxVE\Proxmox;

$password = getenv("PROXMOX_PASSWORD");

$credentials = [
	'hostname' => '192.168.20.2',
	'username' => 'root',
	'password' => $password,
];

$proxmox = new Proxmox($credentials);

// Get some node information
$allNodes = $proxmox->get('/nodes');
$firstNode = $allNodes['data']["0"]["node"];

// Get some VM info from the first (and only) node
global $vms;
$vms = $proxmox->get("/nodes/$firstNode/qemu/");
// print_r($vms);

// Get storage content information (i.e. what ISOs are available)
// $nodeStorages = $proxmox->get("/nodes/$firstNode/storage");
// print_r($nodeStorages);
global $isos;
$isos = $proxmox->get("/nodes/$firstNode/storage/local/content"); //hard-coding "local" as the drive with ISOs on it
// print_r($isos);
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
  <p> -- Build management buttons here --
    <ul>
        <li> List available VMs </li>
        <li> Provision a VM </li>
        <li> Deprovision a VM </li>
        <li> Start a VM </li>
        <li> Stop a VM </li>
    </ul>
  </p>
  <p>
    <h3>Provisioned VMs</h3>
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        <?php
          foreach ( $vms["data"] as &$vm) {
            $id = $vm["vmid"];
            $name = $vm["name"];
            $status = $vm["status"];
            print("
              <tr>
                <td>$id</td>
                <td>$name</td>
                <td>$status</td>
                <td>Start | Stop | Deprovision </td>
              </tr>
            ");
          }
        ?>
      </table>  
  </p>
  <p>
    <h3>Provision a VM</h3>
    <form action="../actions/provision.php" method="post">
      <label for="nodeName"> Node name: </label>
      <input type="text" id="nodeName" name="nodeName" required/>
      <label for="vmid"> VM ID Number: </label>
      <input type="number" id="vmid" name="vmid" required/>
      <label for="iso"> ISO to install: </label>
      <select name="iso">
          <?php
            foreach ($isos["data"] as &$iso) {
              if ($iso["format"] == "iso") {
                $volume = $iso["volid"];
                print("<option 'value=$volume'>$volume</option>");
              };
            }
          ?>
      </select>
      <input type="submit" value="CREATE"/>
    </form>
  </p>

</body>

</html>
