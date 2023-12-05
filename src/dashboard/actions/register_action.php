<?php
session_start();
// ./actions/register_action.php

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

// Register a new user
$username = htmlspecialchars($_POST["username"]);
$password = htmlspecialchars($_POST["password"]);
$confirmPassword = htmlspecialchars($_POST["confirmPassword"]);
$_SESSION['registrationError'] = "";
if ($password !== $confirmPassword) {
	$_SESSION['registrationError'] = "Error: Passwords don't match!";
	header('Location: ../views/register.php');
	die();
}
$checkUsernameSQL = "SELECT username FROM user WHERE username = ?";
$createUserSQL = "INSERT INTO user (username, password, logged_in) VALUES (?, ?, ?)";
$getUserIDSQL = "SELECT id FROM user WHERE username = ?";

if ($stmt = $conn->prepare($checkUsernameSQL)) { //$conn->prepare() checks syntax with DB first. Returns false if it fails or a my_sqli_stmt object
	$stmt->bind_param("s", $username);
	$stmt->execute(); //executes the statement inside the statement object
	$result = $stmt->get_result(); //creates a mysqli_result object
	$resultArray = $result->fetch_array(MYSQLI_NUM); //gets the first row of that result as an array
	/*
	echo "Provided username is: ";
	echo $username;
	echo "<br> Result of SQL query is: ";
	echo $resultArray[0]; //references the first item in that row
	*/
	if ($resultArray[0] == "") {
		//echo "<br>This is a unique username. We need to add it to the DB<br>";
		//insert a new user into the database with value logged_in =  true;
		if ($stmt = $conn->prepare($createUserSQL)) { //attempt to parse createUserSQL syntax and create a my_sqli_stmt object
			$logged_in = 1;
			$password = password_hash($password, PASSWORD_DEFAULT);
			$stmt->bind_param("ssi", $username, $password, $logged_in); //Bind vars string username, string password, int 1 to the sql statement
			$stmt->execute();

			//set session vars for user
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
			//redirect to index.php
			header('Location: ../index.php');
			die();
		}
		else {
			echo "Error: Couldn't prepare createUserSQL query";
		}
	}
	else {
		//echo "This is not a unique username";
		$_SESSION['registrationError'] = "Error: Username already taken!";
		header('Location: ../views/register.php');
		die();
	}
}
else {
	echo "Error: Couldn't prepare checkUsername Query";
}

?>
