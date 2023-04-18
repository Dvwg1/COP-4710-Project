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
    <title>Update Location</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">
<p> Please enter both city and state! </p>

<form action="process-locationchange.php" method="post" >
	<div>
		<label for="newLocale">Enter New Location</label>
		<input type="text" id="newLocale" name="newLocale">
	</div>

	<button>Submit</button>

</form>
