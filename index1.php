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
        			

        <!--<h2>Review a drink!</h2>

        <?php

        //$drink_namesResultSet = $mysqli->query("SELECT drink_name FROM drink_names");

        ?>

    	<form method="post" action="process-review.php">

    		<label for="drinkname">Drink</label>
    		<select name = "EnergyDrinkName" id="EnergyDrinkName">
        		<?php

        		//while($rows = $drink_namesResultSet->fetch_assoc()){
        			//$drinkname = $rows['drink_name'];
        			//echo "<option value='$drinkname'>$drinkname</option>";
        		//}
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

		</form> -->

		<h2>Your Reviews:</h2>

		
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
  			<button>Click to see and edit all reviews</button>
		</a>
		</div>


        <!--<h3>Delete a Review:</h3>
		<?php

		//ensures only energy drinks reviewed by said user are displayed
        //$drink_namesResultSet = $mysqli->query("SELECT drink_name FROM review_information WHERE username ='$user1'");

        ?>

    	<form method="post" action="process-deletion.php">

    		<label for="drinkname">Drink</label>
    		<select name = "EnergyDrinkName" id="EnergyDrinkName">
        		<?php

        		//while($rows = $drink_namesResultSet->fetch_assoc()){
        			//$drinkname = $rows['drink_name'];
        			//echo "<option value='$drinkname'>$drinkname</option>";
        		//}
        		?>
    		</select>	

			<button>Delete Review</button>

		</form> -->

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
				<option value ="manufacturer_info.carnitine_content BETWEEN '251' AND '1000'">251-1000</option>
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

		<h2>Ingredients Information</h2>
		<p> If you don't know much about what the active ingredients do in an energy drink, thats ok! Here is a quick guide to help you get an<br>
			advanced recommendation!<br>
		</p>

		<h4>Caffeine</h4>
		<p>Caffeine is a naturally occuring substance that can be found in coffee beans, tea leaves, kola nuts, cacao nuts, and guarana. Caffeine<br>
			is a stimulant which gives users a sort of "boost of energy", and can make one feel awake. Its effects can last 4-6 hours, and it is<br>
			commonly taken in the form of coffee or energy drinks for purposes of work, studying, and exercise. Side effects can include insomnia,<br>
			headaches, high blood pressure, anxiety, dependency, fast heart rate, and dehydration. The daily FDA recommended limit is 400 mg.<br>
		</p>

		<h4>Vitamin B12</h4>
		<p>Vitamin B12 is a essential vitamin that is typically found in animal foods, and is usually added to cereals and energy drinks. B12's<br>
		   is used by the body for red blood cell production and central nervous system (CNS) maintenenance. B12 is added to energy drinks as it<br>
		   is thought to convert certain macronutrients into energy. Side effects associated with B12 deficiency can include anemia, weakness, <br>
		   loss of balance, numbness, and tingling in the arms and legs. The daily FDA recommended limit for adults is 2.4 mcg.<br>
		 </p>

		<h4>B Vitamins (B3, B5, B6)</h4>
		<P> While all B vitamins have their own specific role, B3 (also commonly known as niacin), B5, and B6 are common in energy drinks as<br>
			they help the body use and get energy from foods consumed. They are also used in cell production. Lack of any of these vitamins can<br>
			have detrimental side effects, and the same could be said about overconsumption. For instance, too much niacin can result in niacin<br>
			poisoning. The daily FDA recommended limit for niacin for adults is 16 mg, 5 mg for B5, and 1.7 mg for B6.<br>
		</P>

		<h4>Carnitine</h4>
		<p> Carnitine is a vitamin like nutrient needed to help cells convert fatty acids into energy. This is the main reason it can be found<br>
			in some energy drinks. Carnitine deficiency can result in confusion, vomiting, muscle weakness, and low blood sugar. For adults, it<br>
			is easy to obtain and may not be needed as much as other nutrients, so there is no recommended limit (at least that I could find).<br>
		</p>

		<h4>Taurine</h4>
		<p> Taurine is an amino acid that can be both found in animal foods and produced by the body. As such, deficiency is unlikely in healthy<br>
			adults. Taurine helps the body regulate hydration and electrolytes, regulate certain minerals, assist with CNS and eye function, and<br>
			help the immune system function properly. It also has anti-inflammatory properties and plays a role in energy conversion.<br>
			The European Food Safety Authority (EFSA) suggets one can safely consume up to 6 grams daily.<br>
		</p>

		<h4>Beta-Alanine</h4>
		<p> Beta-alanine is a non-essential amino acid that is used alongside histidine to produce carnosine, which is then used by the body to<br>
			reduce lactic acid from accumulating in the muscles during strenous activities such as exercise. A common side effect which many find<br>
			to be favorably is that it can cause the sensation of tingling or itchiness under the skin. An effacious dose is 2-3.5 g, and the daily<br>
			recommeded dosage is 2-5 g daily.<br>
		</p>



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
