<?php
	
session_start();

$mysqli = require __DIR__ . "/database.php";


//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

//use of exit prevents junk data from being sent to the user database

//Input Validation
if(empty($_POST["drink_name"])){
	die("drink name is required");
	exit;
}

if(empty($_POST["flavor_profile"])){
	die("flavor is required");
	exit;
}


$drink = $_POST["drink_name"];
//checks to see if manufacturer already inserted
$query = "SELECT * FROM drink_names WHERE drink_name = '$drink'";
$result = $mysqli->query($query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
    	//if found, user is told to try another manufacturer
        echo 'Drink already exists! please try again.!';
        exit;
    } 
}


//insert into users table
$sql = "INSERT INTO drink_names (drink_name, manufacturer, flavor_profile)
		VALUES (?, ?, ?)";

$stmt = $mysqli->stmt_init();

//sql error notification
if ( ! $stmt->prepare($sql)){
	die("SQL error: " . $mysqli->error);
}

//for insertion into table
$stmt->bind_param("sss",
				  $_POST["drink_name"],
				  $_POST["manufacturer1"],
				  $_POST["flavor_profile"]);




$stmt->execute();
echo "Drink successfully added!"

?>