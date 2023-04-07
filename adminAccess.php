<?php
	
session_start();

$user1 = $_SESSION['username'];
$mysqli = require __DIR__ . "/database.php";


?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <meta charset="UTF-8">
</head>
<body style ="background-color: MediumSpringGreen;">
    <h1>Edit Tables</h1>

    <h2>Edit Manufacturers</h2>

    <h3>Add a Manufacturer</h3>

    <!-- Take in user input -->
    <form action="addManu.php" method="post" novalidate>
		<div>
			<label for="manufacturer">Manufacturer</label>
			<input type="text" id="manufacturer" name="manufacturer">
		</div>

		<div>
			<label for="caffeine_content">Caffeine (mg)</label>
			<input type="text" id="caffeine_content" name="caffeine_content">
		</div>

		<div>
			<label for="b12_content">B12 (mcg)</label>
			<input type="text" id="b12_content" name="b12_content">
		</div>

		<div>
			<label for="b_content">B vitamins (mg)</label>
			<input type="text" id="b_content" name="b_content">
		</div>

		<div>
			<label for="carnitine_content">Carnitine (mg)</label>
			<input type="text" id="carnitine_content" name="carnitine_content">
		</div>

		<div>
			<label for="taurine_content">Taurine (mg)</label>
			<input type="text" id="taurine_content" name="taurine_content">
		</div>

		<div>
			<label for="beta_a_content">Beta Alanine (g)</label>
			<input type="text" id="beta_a_content" name="beta_a_content">
		</div>

		<button>Submit</button>
	</form>	
  
    <h3>Remove a Manufacturer</h3>
    <p>Make sure to delete all drinks from said manufacturer beforehand!!!<br>
       Should rarely if ever be executed</p>
     <?php

		//gets manufacturer names to be displayed from manf_info table
		$manf2ResultSet = $mysqli->query("SELECT manufacturer FROM manufacturer_info");
	?>

	<form method="post" action="removeManu.php">

    		<label for="manufacturer2">Manufacturer</label>
    		<select name = "manufacturer2" id="manufacturer2">

    			<option value ="N/A">N/A</option>
        		<?php
        		while($rows = $manf2ResultSet->fetch_assoc()){
        			$manufacturer1 = $rows['manufacturer'];
        			echo "<option value='$manufacturer1'>$manufacturer1</option>";
        		}
        		?>
    		</select>
    	
    	<button>Submit</button>

    </form>


    
    <h2>Edit Drinks</h2>

    <h3>Add a Drink</h3>
    <?php

		//gets manufacturer names to be displayed from manf_info table
		$manf1ResultSet = $mysqli->query("SELECT manufacturer FROM manufacturer_info");
	?>

	<form method="post" action="AddDrink1.php">

		<div>
    		<label for="manufacturer1">Manufacturer</label>
    		<select name = "manufacturer1" id="manufacturer1">

        		<?php
        		while($rows = $manf1ResultSet->fetch_assoc()){
        			$manufacturer = $rows['manufacturer'];
        			echo "<option value='$manufacturer'>$manufacturer</option>";
        		}
        		?>
    		</select>
    	</div>

    	<div>
			<label for="drink_name">Drink Name</label>
			<input type="text" id="drink_name" name="drink_name">
		</div>

		<div>
			<label for="flavor_profile">Flavor</label>
			<input type="text" id="flavor_profile" name="flavor_profile">
		</div>

    	<button>Submit</button>

    </form>

    <h3>Remove a Drink</h3>
    <?php

		//gets drink names to be displayed from drink name table
		$drinkResultSet = $mysqli->query("SELECT drink_name FROM drink_names");
	?>

	<form method="post" action="removeDrink.php">

    	<label for="drink">Drink</label>
    	<select name = "EnergyDrinkName" id="EnergyDrinkName">

    		<option value ="N/A">N/A</option>
        	<?php
        	while($rows = $drinkResultSet->fetch_assoc()){
        		$drinkname = $rows['drink_name'];
        		echo "<option value='$drinkname'>$drinkname</option>";
        	}
        	?>
    	</select>
    
    	<button>Submit</button>
    </form>

    <h2>Remove Users</h2>
     <?php

		//gets drink names to be displayed from drink name table
		$userResultSet = $mysqli->query("SELECT username FROM user");
	?>

	<form method="post" action="removeUser.php">

    	<label for="drink">Drink</label>
    	<select name = "username" id="username">

    		<option value ="N/A">N/A</option>
        	<?php
        	while($rows = $userResultSet->fetch_assoc()){
        		$username = $rows['username'];
        		echo "<option value='$username'>$username</option>";
        	}
        	?>
    	</select>
    
    	<button>Submit</button>
    </form>

    <p><a href="index1.php">Return Home</a></p>


</body>
</html>