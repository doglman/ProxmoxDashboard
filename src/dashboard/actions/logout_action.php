<?php
// ./actions/logout_action.php
session_start();
// Read variables and create connection
$mysql_servername = getenv("MYSQL_SERVERNAME");
$mysql_user = getenv("MYSQL_USER");
$mysql_password = getenv("MYSQL_PASSWORD");
$mysql_database = getenv("MYSQL_DATABASE");
$conn = new mysqli($mysql_servername, $mysql_user, $mysql_password, $mysql_database);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

//Log the user out
//echo "This is the logout screen!";
$setUserLoginSQL = "UPDATE user SET logged_in=0 WHERE username = ?";

if ($stmt = $conn->prepare($setUserLoginSQL)) {
	$stmt->bind_param("s", $_SESSION['username']);
	//echo "_SESSION username is: ";
	//echo $_SESSION['username'];
	$stmt->execute();

	session_unset(); //removes all session variables
	session_destroy(); //destroy session
	header('Location: ../views/login.php');
	die();
}
else {
	echo "Error: Couldn't prepare setUserLoginSQL Query";
}
?>
