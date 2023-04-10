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
    <title>Update Email</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">

<form action="process-emailchange.php" method="post" >
	<div>
		<label for="newEmail">Enter New Email</label>
		<input type="text" id="newEmail" name="newEmail">
	</div>

	<button>Submit</button>

</form>
