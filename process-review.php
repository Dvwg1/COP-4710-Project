<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$dname = $_POST["EnergyDrinkName"];
$uname = $_SESSION["username"];

$rname = $_POST["RatingNumber"];
$cname = $_POST["comment"];

//checks to see review already exists from that user
$query = "SELECT * FROM review_information WHERE drink_name = '$dname'";
$result = $mysqli->query($query);

if (mysqli_num_rows($result) > 0) {
	//if found, review is overwritten, user "updates" review
	$query1 = "DELETE FROM review_information WHERE drink_name  = '$dname' AND username = '$uname'";
	$result1 = $mysqli->query($query1);
    

}


//insert into users table
$sql = "INSERT INTO review_information (username, drink_name, rating, comment)
		VALUES (?, ?, ? ,?)";

$stmt = $mysqli->stmt_init();

//sql error notification
if ( ! $stmt->prepare($sql)){
	die("SQL error: " . $mysqli->error);
}

//for insertion into table
$stmt->bind_param("ssis",
				  $_SESSION["username"],
				  $_POST["EnergyDrinkName"],
				  $_POST["RatingNumber"],
				  $_POST["comment"]);


$stmt->execute();


header("Location: index1.php");
//exit;