<?php

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

//use of exit prevents junk data from being sent to the user database

//username validation
if(empty($_POST["username"])){
	die("Username is required");
	exit;
}
if( preg_match('/\s/', $_POST["username"]))
{
	die("Please do not use whitespaces in username");
	exit;
}
if( strlen($_POST["username"]) > 30){
	die("Max length for username is 30 characters.");
	exit;
}

//email validation
if( !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
	die("Please enter a valid email");
	exit;
}

//name validation
if(empty($_POST["name"])){
	die("Name is required");
	exit;
}

//password length validation
if( strlen($_POST["password"]) < 8){
	die("Your password must be a minimum of 8 characters");
	exit;
}

//password char validation
if( !preg_match("/[a-z]/i", $_POST["password"])){
	die("Your password must contain at least one letter (a-z)");
	exit;
}

//password int validation
if( !preg_match("/[0-9]/i", $_POST["password"])){
	die("Your password must contain at least one number (0-9)");
	exit;
}

//password confirmation validation
if($_POST["password"] != $_POST["password_confirm"]){
	die("Please ensure that passwords match");
	exit;
}


//variables to check if user and/or email are already taken
$user1 = $_POST["username"];
$email1 = $_POST["email"];


//hash function
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

//for sql connection
$mysqli = require __DIR__ . "/database.php";

//checks to see if username taken
$query = "SELECT * FROM user WHERE username = '$user1'";
$result = $mysqli->query($query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
    	//if found, user is told to try another username
        echo 'username taken! please try again.!';
        exit;
    } else {
        echo '';
        
    }
}
//checks to see if email is taken
$query = "SELECT * FROM user WHERE email = '$email1'";
$result = $mysqli->query($query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
    	//if found, user is told to try another email
        echo 'email taken! please try again.!';
        exit;
    } else {
        echo '';
        
    }
}

//insert into users table
$sql = "INSERT INTO user (username, password, name, email, location)
		VALUES (?, ?, ? ,? ,?)";

$stmt = $mysqli->stmt_init();

//sql error notification
if ( ! $stmt->prepare($sql)){
	die("SQL error: " . $mysqli->error);
}

//for insertion into table
$stmt->bind_param("sssss",
				  $_POST["username"],
				  $password_hash,
				  $_POST["name"],
				  $_POST["email"],
				  $_POST["location"]);


$stmt->execute();
header("Location: success-signup.html");
exit;

