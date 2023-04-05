<!DOCTYPE html>
<html>
<head>
    <title>Recommendations</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">
    <h1>Energy Drink Recommendations: Basic</h1>
    <?php

	session_start();

	//keeps the page same color
    echo '<body style ="background-color: MediumSpringGreen;">';

	$mysqli = require __DIR__ . "/database.php";

	//stores potential conditions
	$wheres = array();

	//creates first condition comparison
	$firstCond = 'manufacturer = ';
	$firstCond .= "'" . $_POST['manufacturer'] ."'";

	//creates second condition comparison
	$secCond = 'flavor_profile = ';
	$secCond .= "'" . $_POST['flavor'] ."'";

	if ($_POST['manufacturer'] != "N/A" ){
		array_push($wheres, $firstCond);
	}

	if ($_POST['flavor'] != "N/A" ){
		array_push($wheres, $secCond);
	}


	$query = "SELECT * FROM drink_names";

	if( !empty($wheres)){
		//concenates complete query
		$query .=" WHERE " . implode(' AND ', $wheres);
	}


	$result = $mysqli->query($query);


	/*while ($row = mysqli_fetch_array($result)){
		echo $row['drink_name'] . " | " ;
	}*/


	?>

<form method="post" action="moreinfo.php">
	<label for="drinkname">Drink</label>
    	<select name = "EnergyDrinkName" id="EnergyDrinkName">
        	<?php

        		while($row = mysqli_fetch_array($result)){
        			$drinkname = $row['drink_name'];
        			echo "<option value='$drinkname'>$drinkname</option>";
        		}
        	?>
    	</select>	
	<button>Get More Info</button>
</form>



    <p><a href="index1.php">Return Home</a></p>
</body>
</html>


