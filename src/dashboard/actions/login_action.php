<?php
// ./actions/login_action.php
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

// TODO: Log the user in
$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);
$_SESSION['loginError'] = "";

$checkUsernameSQL = "SELECT username FROM user WHERE username = ?";
$getPasswordHashSQL = "SELECT password FROM user WHERE username = ?";
$getUserIDSQL = "SELECT id FROM user WHERE username = ?";
$setUserLoginSQL = "UPDATE user SET logged_in=1 WHERE username= ?";

if ($stmt = $conn->prepare($checkUsernameSQL)) {
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$result = $stmt->get_result();
	$resultArray = $result->fetch_array(MYSQLI_NUM);
	if ($resultArray[0] == "") { //If the username doesn't already exist
		$_SESSION['loginError'] = "Error: That username doesn't exist";
		header('Location: ../views/login.php');
		die();
	}
	else { //The username DOES exist
		//echo "That's a valid username!<br>";
		//Look up password hash
		if ($stmt = $conn->prepare($getPasswordHashSQL)) {
			$stmt->bind_param("s",$username);
			$stmt->execute();
			$result = $stmt->get_result();
			$resultArray = $result->fetch_array(MYSQLI_NUM);
			if (password_verify($password, $resultArray[0])) { //Do the passwords match?
				//echo "The password matches!";
				//set session variables for the user
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $username;
				if ($stmt = $conn->prepare($getUserIDSQL)) {
					$stmt->bind_param("s", $username);
					$stmt->execute();
					$result = $stmt->get_result();
					$resultArray = $result->fetch_array(MYSQLI_NUM);
					$_SESSION['userID'] = $resultArray[0];
				}
				else {
					echo "Error: Couldn't prepare getUserIDSQL query";
				}

				//update logged_in var in database
				if ($stmt = $conn->prepare($setUserLoginSQL)) {
					$stmt->bind_param("s", $username);
					$stmt->execute();
				}
				else {
					echo "Error: Couldn't prepare setUserLoginSQL query";
				}
				//redirect user
				header('Location: ../index.php');
				die();
			}
			else {
				//echo "The password doesn't match";
				$_SESSION['loginError'] = "Error: Incorrect Password";
				header('Location: ../views/login.php');
				die(); //XD favorite name for a function
			}
		}
		else {
			echo "Error: Couldn't prepare getPasswordHash Query";
		}
	}
}
else {
	echo "Error: Couldn't prepare checkUsername Query";
}
?>
