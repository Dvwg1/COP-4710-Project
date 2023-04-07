<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$mname = $_POST["manufacturer2"];

if ($mname == "N/A")
{
	echo "no manufacturer selected, go back";
	exit;

}


//deletes manufacturer
$query0 = "DELETE FROM manufacturer_info WHERE manufacturer  = '$mname'";
$result0 = $mysqli->query($query0);


header("Location: adminAccess.php");
//exit;