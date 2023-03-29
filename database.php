<?php

$host = "localhost";
$dbname = "low cal energy drink";
$username = "root";
$password = "";

//variable for connection
$mysqli = new mysqli($host, $username, $password, $dbname);

//connection error warning
if ($mysqli->connect_errno){
	die("Connection Error: " . $mysqli->connect_error);

}

//return variable
return $mysqli;