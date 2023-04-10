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
    <title>User Settings</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">
    <h1><?php  echo $user["name"]; ?>'s Profile Settings</h1>

    <h2>Name</h2>
    <p><?php  echo $user["name"]; ?></p>
    <h2>Username</h2>
    <p><?php  echo $user["username"]; ?></p>
    <h2>Email</h2>
    <p><?php  echo $user["email"]; ?>
    	<a href="email-change.php">
  			<button>Click to update email</button>
		</a>
    </p>
    <h2>Set Location</h2>
    <p><?php  echo $user["location"]; ?></p>

    <h2>Password</h2>
    <a href="password-change.php">
  		<button>Click to change password</button>
	</a>

<p><a href="index1.php">Return Home</a></p>
</body>
</html>