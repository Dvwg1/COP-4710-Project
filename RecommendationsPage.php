<?php

session_start();


$drinkData = $_SESSION['drinks'];


?>

<!DOCTYPE html>
<html>
<head>
    <title>Recommendations</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">
    <h1>Energy Drink Recommendations:</h1>

<form method="post" action="moreinfo.php">
	<label for="drinkname">Drink</label>
    <select name = "EnergyDrinkName" id="EnergyDrinkName">

        <?php
        	foreach($drinkData as $drink){
            	echo "<option value='$drink'>$drink</option>";
        	}
        ?>
    </select>

	<button>Get More Info</button>
</form>

 <p><a href="index1.php">Return Home</a></p>
</body>
</html>