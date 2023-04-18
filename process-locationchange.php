<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$uname = $_SESSION["username"];

$newLocale = $_POST["newLocale"];


//uses UPDATE to update user's location
$query = "UPDATE user SET location = '$newLocale' WHERE username  = '$uname'";
$result = $mysqli->query($query);

header("Location: user-settings.php");
exit;

?>