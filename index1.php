<?php

session_start();

if (isset($_SESSION["username"])) {
    
    $mysqli = require __DIR__ . "/database.php";

    $user1 = $_SESSION["username"];
    
    $sql = "SELECT * FROM user WHERE username = '$user1'";

    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

    
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <style>
	table, th, td {
  		border: 1px solid black;
  		border-collapse: collapse;
	}
	th, td {
  		padding: 4px;
	}
	</style>
</head>
<body style ="background-color: MediumSpringGreen;">
    <h1>Low Cal Energy Drink Recommendations: Home</h1>
    
    <?php if (isset($user)): ?>
        
        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>

        <h2>Review a drink!</h2>

        <?php

        $drink_namesResultSet = $mysqli->query("SELECT drink_name FROM drink_names");

        ?>

    	<form method="post" action="process-review.php">

    		<label for="drinkname">Drink</label>
    		<select name = "EnergyDrinkName" id="EnergyDrinkName">
        		<?php

        		while($rows = $drink_namesResultSet->fetch_assoc()){
        			$drinkname = $rows['drink_name'];
        			echo "<option value='$drinkname'>$drinkname</option>";
        		}
        		?>
    		</select>	


			<label for="review">Comment</label>
			<input type="text" id="comment" name="comment">
		
			<label for="rating">Rating</label>
			<select name = "RatingNumber" id="RatingNumber">
				<option value ="1">1</option>
				<option value ="2">2</option>
				<option value ="3">3</option>
				<option value ="4">4</option>
				<option value ="5">5</option>
				<option value ="6">6</option>
				<option value ="7">7</option>
				<option value ="8">8</option>
				<option value ="9">9</option>
				<option value ="10">10</option>
			</select>
			

			<button>submit review</button>


		
		</form>

		<h3>Your Past Reviews:</h3>

		
        <table style ="background-color: GhostWhite ;">
        	<tr>
        		<th>Drink</th>
        		<th>Comment</th>
        		<th>Rating</th>
        	</tr>
        	<tr>
        		<?php

        			$ReviewsResultSet = $mysqli->query("SELECT * FROM review_information WHERE username = '$user1'");
        			while($rows = $ReviewsResultSet->fetch_assoc()){
        			echo '<tr>';
        			echo '<td>'. $rows['drink_name'] .'</td>';
        			echo '<td>'. $rows['comment'] .'</td>';
        			echo '<td>'. $rows['rating'] .'</td>';
        			echo '</tr>';
        			}
        		?>
        	</tr>
        </table>

        <h3>Delete a Review:</h3>
		<?php

		//ensures only energy drinks reviewed by said user are displayed
        $drink_namesResultSet = $mysqli->query("SELECT drink_name FROM review_information WHERE username ='$user1'");

        ?>

    	<form method="post" action="process-deletion.php">

    		<label for="drinkname">Drink</label>
    		<select name = "EnergyDrinkName" id="EnergyDrinkName">
        		<?php

        		while($rows = $drink_namesResultSet->fetch_assoc()){
        			$drinkname = $rows['drink_name'];
        			echo "<option value='$drinkname'>$drinkname</option>";
        		}
        		?>
    		</select>	

			<button>Delete Review</button>


		
		</form>

		<h2>Basic Recommendation:</h2>
		<p>These recommendations are based on manufacturer and/or flavor desired, perfect if you already know which manufacturer you prefer<br>
		    or if you just want a drink recommendation solely based on flavor!<br>
		</p>

		<?php

		//gets manufacturer names to be displayed from manf_info table
		$manf1ResultSet = $mysqli->query("SELECT * FROM manufacturer_info");

		//gets flavor profile instances from drink_names table (including dups)
		$flavorResultSet = $mysqli->query("SELECT * FROM drink_names");

		//flavors array
		$flavA = array();

		//fills in array
		while($rows = $flavorResultSet->fetch_assoc()){
        			$flavor = $rows['flavor_profile'];
        			array_push($flavA, $flavor);

        }

        //removes duplicates
        $flavA = array_unique($flavA);

        ?>

    	<form method="post" action="process-basic.php">

    		<label for="manufacturer">Manufacturer</label>
    		<select name = "manufacturer" id="manufacturer">

				<option value ="N/A">N/A</option>
        		<?php
        		while($rows = $manf1ResultSet->fetch_assoc()){
        			$manufacturer = $rows['manufacturer'];
        			echo "<option value='$manufacturer'>$manufacturer</option>";
        		}
        		?>
    		</select>

    		<label for="flavor">Flavor</label>
    		<select name = "flavor" id="flavor">

				<option value ="N/A">N/A</option>
        		<?php
        		foreach($flavA as $item){
            		echo "<option value='$item'>$item</option>";
        		}
        		?>
    		</select>

			<button>get recommendation!</button>


		</form>

		<h2>Advanced Recommendation:</h2>
		<p> Perfect you are unsure about what manufacturer you prefer, or perhaps you solely care about ingredients and/or flavor. you can<br>
			also search based on a drink's average rating.<br>
		</p>





       
        <p><a href="logout.php">Log out</a></p>
        
    <?php else: ?>
        
        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
        
    <?php endif; ?>

     
    
</body>
</html>
