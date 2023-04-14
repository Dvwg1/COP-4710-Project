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

	h1 {
		text-align: center;
	}
	</style>
</head>
<body style ="background-color: MediumSpringGreen;">
    <h1>Low Cal Energy Drink Recommendations</h1>
    
    <?php if (isset($user)): ?>
        
        <h3>Hello <?= htmlspecialchars($user["name"]) ?></h3>

        <!-- link to where user can change username and/or password -->
        <a href="user-settings.php">
  			<button>Profile Settings</button>
		</a>

		
        <!-- Allows admin (Dvwg) to edit certain table via php -->
        <?php if ($_SESSION["username"] == "Dvwg")
        {
        	$link_address = "adminAccess.php";

        	echo "<h2>Admin Access</h2>";
        	echo "<a href='".$link_address."'>click to edit database</a>";
        }
        ?>

    	<h2>About</h2>
	
		<p>This website can provide you with a low calorie energy drink recommendation based on desired manufacturer, flavor, and/or ingredients. Information<br>
	 	is also provided on ingredient effects and effacacious dosages.</p>


		<p>DISCLAIMER: This website does not provide medical advice, and energy drinks should only be consumed by healthy individuals in moderation.<br>
	 	We are not affiliated with any of the manufacturers and vendors. The intention of this website is solely to give energy drink suggestions based on user parameters.<p>

	 	<h2>Manufacturers</h2>
	 	
        <ul>
        	<?php
        		$diffManus = $mysqli->query("SELECT * FROM manufacturer_info");
        		while($rows = $diffManus->fetch_assoc()){
        			echo '<li>'. $rows['manufacturer'] . '</td>';
        		}
        	?>
        </ul>
        			

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

        			//shows only top five, users have to click link to see more
        			$ReviewsResultSet = $mysqli->query("SELECT * FROM review_information WHERE username = '$user1' LIMIT 5");
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

		<div>
        <a href="user-reviews.php">
  			<button>Click to see all reviews</button>
		</a>
		</div>


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
		$manf1ResultSet = $mysqli->query("SELECT manufacturer FROM manufacturer_info");

		//gets flavor profile instances from drink_names table (including dups)
		$flavorResultSet = $mysqli->query("SELECT flavor_profile FROM drink_names");

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
		<p> Perfect you are unsure about what manufacturer you prefer, or perhaps you solely care about ingredients and/or flavor. You can<br>
			also search based on a drink's average rating.<br>
		</p>

		<form method="post" action="process-advanced1.php">
			<label for="flavor">Flavor</label>
    		<select name = "flavor" id="flavor">

				<option value ="N/A">N/A</option>
        		<?php
        		foreach($flavA as $item){
            		echo "<option value='$item'>$item</option>";
        		}
        		?>
    		</select>

    		<!-- prefabricated sql statements -->
			<label for="caffeine">Caffeine Content (mg)</label>
			<select name = "caffeine" id="caffeine">
				<option value ="N/A">N/A</option>
				<option value ="manufacturer_info.caffeine_content = '150'">150</option>
				<option value ="manufacturer_info.caffeine_content BETWEEN '150' AND '200'">150-200</option>
				<option value ="manufacturer_info.caffeine_content BETWEEN '200' AND '300'">200-300</option>
				<option value ="manufacturer_info.caffeine_content = '300'">300</option>
			</select>

			<label for="b12">Vitamin B12 Content (mcg)</label>
			<select name = "b12" id="b12">
				<option value ="N/A">N/A</option>
				<option value ="manufacturer_info.b12_content = '0'">0</option>
				<option value ="manufacturer_info.b12_content BETWEEN '1' AND '4'">1-4</option>
				<option value ="manufacturer_info.b12_content BETWEEN '5' AND '8'">5-8</option>
				<option value ="manufacturer_info.b12_content BETWEEN '9' AND '12'">9-12</option>
				<option value ="manufacturer_info.b12_content >= '100'">>= 100</option>
			</select>

			<label for="bv">B Vitamin Content (mg)</label>
			<select name = "bv" id="bv">
				<option value ="N/A">N/A</option>
				<option value ="manufacturer_info.b_content = '0'">0</option>
				<option value ="manufacturer_info.b_content BETWEEN '1' AND '10'">1-10</option>
				<option value ="manufacturer_info.b_content BETWEEN '11' AND '20'">11-20</option>
				<option value ="manufacturer_info.b_content BETWEEN '21' AND '30'">21-30</option>
				<option value ="manufacturer_info.b_content BETWEEN '31' AND '35'">31-35</option>
			</select>

			<label for="carnitine">Carnitine Content (mg)</label>
			<select name = "carnitine" id="carnitine">
				<option value ="N/A">N/A</option>
				<option value ="manufacturer_info.carnitine_content = '0'">0</option>
				<option value ="manufacturer_info.carnitine_content BETWEEN '200' AND '250'">200-250</option>
				<option value ="manufacturer_info.carnitine_content BETWEEN '251' AND '1000'">>=251-1000</option>
				<option value ="manufacturer_info.carnitine_content = '1000'">1000</option>

			</select>

			<label for="taurine">Taurine Content (mg)</label>
			<select name = "taurine" id="taurine">
				<option value ="N/A">N/A</option>
				<option value ="manufacturer_info.taurine_content = '0'">0</option>
				<option value ="manufacturer_info.taurine_content = '100'">100</option>
				<option value ="manufacturer_info.taurine_content BETWEEN '101' AND '250'">101-250</option>
				<option value ="manufacturer_info.taurine_content BETWEEN '251' AND '500'">251-500</option>
				<option value ="manufacturer_info.taurine_content BETWEEN '251' AND '1000'">501-1000</option>
				<option value ="manufacturer_info.taurine_content = '1000'">1000</option>
			</select>

			<label for="beta">Beta Alanine Content (g)</label>
			<select name = "beta" id="beta">
				<option value ="N/A">N/A</option>
				<option value ="manufacturer_info.beta_a_content = '0'">0</option>
				<option value ="manufacturer_info.beta_a_content >= '1'">yes</option>
			</select>

			<!--
			<label for="ratingAvg">Average_Rating</label>
			<select name = "ratingAvg" id="ratingAvg">
				<option value ="N/A">N/A</option>
				<option value ="1">poor(1-2)</option>
				<option value ="2">subpar(3-4)</option>
				<option value ="3">good(5-6)</option>
				<option value ="4">great(7-8)</option>
				<option value ="3">excellent(9-10)</option>
			</select> -->


			

			<button>get recommendation!</button>

		</form>

		<h3>Ingredients Information</h3>
		<p> If you don't know much about what the active ingredients do in an energy drink, thats ok! Here is a quick guide to help you get an<br>
			advanced recommendation!<br>
		</p>

		<h4>Caffeine</h4>
		<h4>Vitamin B12</h4>
		<h4>B Vitamins (B3, B5, B6)</h4>
		<h4>Carnitine</h4>
		<h4>Taurine</h4>
		<h4>Beta Alanine</h4>

		<h3>Sources Cited</h3>
		<p style="font-size:80%;">testing</p>


		<h2>Your Past Recommendations</h2>

		<table style ="background-color: GhostWhite ;">
        	<tr>
        		<th>Drink</th>
        		<th>Timestamp</th>
        	</tr>
        	<tr>
        		<?php

        			$RecResultSet = $mysqli->query("SELECT * FROM recommends WHERE username = '$user1'");
        			while($rows = $RecResultSet->fetch_assoc()){
        			echo '<tr>';
        			echo '<td>'. $rows['drink_name'] .'</td>';
        			echo '<td>'. $rows['date_time'] .'</td>';
        			echo '</tr>';
        			}
        		?>
        	</tr>
        </table>

        <form method="post" action = 'clearHist.php'>
        	<input type = "submit" name = "Clear History" class="button" value="Clear History" />
        </form>

        
        
     

       
        <p><a href="logout.php">Log out</a></p>
        
    <?php else: ?>
        
        <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>
        
    <?php endif; ?>

     
    
</body>
</html>
