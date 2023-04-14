<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$uname = $_SESSION["username"];

$location = $_POST["location1"];

//echo "$location";

//uses UPDATE to update location
$query = "UPDATE user SET location = '$location' WHERE username  = '$uname'";
$result = $mysqli->query($query);

//doesn't go directly back to moreinfo.php as this causes errors
header("Location: RecommendationsPage.php");
//exit;

?>
