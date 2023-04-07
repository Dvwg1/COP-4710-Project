<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$uname = $_POST["username"];


if ($uname == "N/A")
{
	echo "no user selected, go back";
	exit;

}


//deletes user from all reviews
$query0 = "DELETE FROM review_information WHERE username  = '$uname'";
$result0 = $mysqli->query($query0);

//deletes user from all recommendations
$query1 = "DELETE FROM recommends WHERE username  = '$uname'";
$result1 = $mysqli->query($query1);

//can now delete user drom user
$query1 = "DELETE FROM user WHERE username  = '$uname'";
$result1 = $mysqli->query($query1);

header("Location: adminAccess.php");
//exit;

?>
