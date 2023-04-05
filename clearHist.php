<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$uname = $_SESSION["username"];

//deletes all records associated with user
$query1 = "DELETE FROM recommends WHERE username = '$uname'";
$result1 = $mysqli->query($query1);


header("Location: index1.php");
//exit;