<?php
error_reporting(-1);
session_start();
// Check to make sure the user is logged in
if (!array_key_exists('logged_in', $_SESSION)) {
  header('Location: ./views/login.php');
  die();
}

require_once '../vendor/autoload.php';
use ProxmoxVE\Proxmox;

//Acquire credentials from the Apache environment (controlled by the `.env` file)
$credentials = [
	'hostname' => getenv("PROXMOX_HOSTNAME"),
	'username' => getenv("PROXMOX_USERNAME"),
	'password' => getenv("PROXMOX_PASSWORD"),
];
$proxmox = new Proxmox($credentials);

// Get some node information
$allNodes = $proxmox->get('/nodes');
$firstNode = $allNodes['data']["0"]["node"];

$vmid = $_POST["vmid"];

//TODO - call DELETE on "/nodes/$firstNode/qemu/$vmid"
$proxmox->delete("/nodes/$firstNode/qemu/$vmid");

header('Location: ../views/manage.php')

?>