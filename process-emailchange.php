<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$uname = $_SESSION["username"];

$newEmail = $_POST["newEmail"];

//email validation
if( !filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
	die("Please enter a valid email");
	exit;
}

//checks to see if email is taken
$query = "SELECT * FROM user WHERE email = '$newEmail'";
$result = $mysqli->query($query);
if ($result) {
    if (mysqli_num_rows($result) > 0) {
    	//if found, user is told to try another email
        echo 'email taken! please try again.!';
        exit;
    } else {
        echo '';
        
    }
}

//uses UPDATE to update user's email
$query = "UPDATE user SET email = '$newEmail' WHERE username  = '$uname'";
$result = $mysqli->query($query);

header("Location: user-settings.php");
exit;

?>
