<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$dname = $_POST["EnergyDrinkName"];
$uname = $_SESSION["username"];

//deletes energy drink
$query1 = "DELETE FROM review_information WHERE drink_name  = '$dname' AND username = '$uname'";
$result1 = $mysqli->query($query1);


header("Location: index1.php");
//exit;