<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$dname = $_POST["EnergyDrinkName"];


if ($dname == "N/A")
{
	echo "no drink selected, go back";
	exit;

}


//deletes energy drink from all reviews
$query0 = "DELETE FROM review_information WHERE drink_name  = '$dname'";
$result0 = $mysqli->query($query0);

//deletes energy drink from all recommendations
$query1 = "DELETE FROM recommends WHERE drink_name  = '$dname'";
$result1 = $mysqli->query($query1);

//can now delete energy drink drom drink_names
$query1 = "DELETE FROM drink_names WHERE drink_name  = '$dname'";
$result1 = $mysqli->query($query1);

header("Location: adminAccess.php");
//exit;
?>