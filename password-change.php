<?php

session_start();

$mysqli = require __DIR__ . "/database.php";

$user1 = $_SESSION["username"];

$sql = "SELECT * FROM user WHERE username = '$user1'";

$result = $mysqli->query($sql);
    
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">

<form action="process-passchange.php" method="post" >
	<div>
		<label for="oldPass">Enter Current Password</label>
		<input type="password" id="oldPass" name="oldPass">
	</div>

	<div>
		<label for="newPass">Enter New Password</label>
		<input type="password" id="newPass" name="newPass">
	</div>

	<div>
		<label for="password_confirm">Please Repeat New Password</label>
		<input type="password" id="newPass_confirm" name="newPass_confirm">
	</div>



	<button>Submit</button>

</form>