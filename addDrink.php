<?php
	
session_start();

$user1 = $_SESSION['username'];
$mysqli = require __DIR__ . "/database.php";


//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

//use of exit prevents junk data from being sent to the user database

//Input Validation
if(empty($_POST["manufacturer"])){
	die("manufacturer is required");
	exit;
}

if(empty($_POST["caffeine_content"])){
	die("caffeine content is required");
	exit;
}

//if nothing has been entered for the other ingredients, default made 0
if(empty($_POST["b12_content"])){
	$_POST["b12_content"] = 0;
}

if(empty($_POST["b_content"])){
	$_POST["b_content"] = 0;
	
}

if(empty($_POST["carnitine_content"])){
	$_POST["carnitine_content"] = 0;
	
}

if(empty($_POST["taurine_content"])){
	$_POST["taurine_content"] = 0;
	
}

if(empty($_POST["beta_a_content"])){
	$_POST["beta_a_content"] = 0;
	
}


$manufacturer = $_POST["manufacturer"];
//checks to see if manufacturer already inserted
$query = "SELECT * FROM manufacturer_info WHERE manufacturer = '$manufacturer'";
$result = $mysqli->query($query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
    	//if found, user is told to try another manufacturer
        echo 'Manufacturer already exists! please try again.!';
        exit;
    } 
}



?>