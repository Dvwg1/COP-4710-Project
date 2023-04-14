<?php

session_start();

$user1 = $_SESSION['username'];

$mysqli = require __DIR__ . "/database.php";

//stores drink user wants to know more about
$drinkname = $_SESSION["drinkname"];

//stores the drink manufacturer in question
$manu =  $_SESSION["manu"];

//stores users location
$location = $_SESSION["location"];

//constructs query to be used on google maps
$query = "'" . $manu . " energy " . $drinkname . " for sale in " . $location . "'";
//echo $query;




?>

<!DOCTYPE html>
<html>
<head>
    <title>Availability</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">

	<script type="text/javascript" charset="utf-8">
		function search()
		{
    		//converts php variable to javascript
    		query = <?php echo $query; ?>;
    		//concacenates search
    		url ='http://www.google.com/maps/search/' + query;
    		window.open(url,'_blank');
		}
	</script>

	<input type="submit" value="get location!" onclick="search();">

	<p><a href="RecommendationsPage.php">Return to Recommendations</a></p>

</body>
</html>

