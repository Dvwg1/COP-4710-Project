<!DOCTYPE html>
<html>
<head>
    <title>Recommendations</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">
    <h1>Energy Drink Recommendations: Advanced</h1>
<?php

	session_start();

	//keeps the page same color
    echo '<body style ="background-color: MediumSpringGreen;">';

    $user1 = $_SESSION['username'];

	$mysqli = require __DIR__ . "/database.php";

	//stores potential conditions
	$wheres = array();

	//creates first condition comparison
	$firstCond = 'drink_names.flavor_profile = ';
	$firstCond .= "'" . $_POST['flavor'] ."'";

	//second condition comparison variable
	$secCond = $_POST['caffeine'];

	//third condition comparison variable
	$thirdCond = $_POST['b12'];

	//fourth condition comparison variable
	$fourCond = $_POST['bv'];

	//fifth condition comparison variable
	$fifCond = $_POST['carnitine'];

	//sixth condition comparison variable
	$sixCond = $_POST['taurine'];

	//seventh condition comparions variable
	$sevCond = $_POST['beta'];

	if ($_POST['flavor'] != "N/A"){
		array_push($wheres, $firstCond);
	}

	if ($_POST['caffeine'] != "N/A"){
		array_push($wheres, $secCond);
	}

	if ($_POST['b12'] != "N/A"){
		array_push($wheres, $thirdCond);
	}

	if ($_POST['bv'] != "N/A"){
		array_push($wheres, $fourCond);
	}

	if ($_POST['carnitine'] != "N/A"){
		array_push($wheres, $fifCond);
	}

	if ($_POST['taurine'] != "N/A"){
		array_push($wheres, $sixCond);
	}

	if ($_POST['beta'] != "N/A"){
		array_push($wheres, $sevCond);
	}

	$query = "SELECT drink_names.drink_name
			  FROM drink_names, manufacturer_info
			  WHERE drink_names.manufacturer = manufacturer_info.manufacturer";


	if( !empty($wheres)){
		//concenates complete query
		$query .=" AND " . implode(' AND ', $wheres);
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