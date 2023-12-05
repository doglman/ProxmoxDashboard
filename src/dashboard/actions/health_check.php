<?php
// ./actions/health_check.php

// Read variables and create connection

session_start();
echo "SESSION VARIABLES <br>";
var_dump($_SESSION);

$mysql_servername = getenv("MYSQL_SERVERNAME");
$mysql_user = getenv("MYSQL_USER");
$mysql_password = getenv("MYSQL_PASSWORD");
$mysql_database = getenv("MYSQL_DATABASE");

// This section for DEBUGGING ONLY! COMMENT-OUT WHEN FINISHED
echo "<p>mysql_servername: $mysql_servername</p>";
echo "<p>mysql_user: $mysql_user</p>";
echo "<p>mysql_password: $mysql_password</p>";
echo "<p>mysql_database: $mysql_database</p>";

$conn = new mysqli($mysql_servername, $mysql_user, $mysql_password, $mysql_database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} else {
	echo "Database Connection Success";
}

?>