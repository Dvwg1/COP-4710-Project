<?php

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    //checks to see if there that username in the database
    $sql = sprintf("SELECT * FROM user
                    WHERE username = '%s'",
                    $mysqli->real_escape_string($_POST["username"]));
    
    //storesquery result
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    //if user exists, password is verified
    if($user){

    	//if password matches, login is successful
    	if(password_verify($_POST["password"], $user["password"])){
    		
    		//starts a user session
    		session_start();

    		session_regenerate_id();

    		$_SESSION["username"] = $user["username"];

    		header("Location: index1.php");
    		exit;

    	}
    }

    $is_invalid = true;

}
    
    
?>

<!DOCTYPE html>
<html>
<head>
	<title>User Login</title>
	<meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">
	<center>
	<h1>Low Cal Energy Drink Recommendations: User Login</h1>

	<?php if ($is_invalid): ?>
		<em>Invalid login</em>
	<?php endif; ?>

	<form method="post">
		<label for="username">Username</label>
		<input type="text" id="username" name="username">
		
		<label for="password">Password</label>
		<input type="password" id="password" name="password">

		<button>Login</button>
		
	</form>

	</center>
</body>

