<?php

session_start();

$user1 = $_SESSION['username'];

$mysqli = require __DIR__ . "/database.php";


//gets energy drink to display to user + fetch review based information
$drinkname = $_POST['EnergyDrinkName'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>More Info</title>
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
    <h1>Information on: <?php  echo $drinkname; ?></h1>


    <h2>User Reviews</h2>
     <table style ="background-color: GhostWhite ;">
        	<tr>
        		<th>User</th>
        		<th>Comment</th>
        		<th>Rating</th>
        	</tr>
        	<tr>
        		<?php

        			$ReviewsResultSet = $mysqli->query("SELECT * FROM review_information WHERE drink_name = '$drinkname'");
        			while($rows = $ReviewsResultSet->fetch_assoc()){
        			echo '<tr>';
        			echo '<td>'. $rows['username'] .'</td>';
        			echo '<td>'. $rows['comment'] .'</td>';
        			echo '<td>'. $rows['rating'] .'</td>';
        			echo '</tr>';
        			}
        		?>
        	</tr>
        </table>


    <?php
        //aggregate query to get average rating of a drink
        $averageRating = $mysqli->query("SELECT AVG(rating) FROM review_information WHERE drink_name = '$drinkname'");
        $averageResult = $averageRating->fetch_row()
    ?>
    <h3>Average rating: <?php echo $averageResult[0] ?></h3>


     <?php
        $manuInfo = $mysqli->query("SELECT manufacturer FROM drink_names WHERE drink_name = '$drinkname'");
        $manuResult = $manuInfo->fetch_row()
    ?>
    <h3>Manufacturer: <?php echo $manuResult[0] ?></h3>

    <h2>Local Availabilty</h2>


    <?php
        $locationInfo = $mysqli->query("SELECT location FROM user WHERE username = '$user1'");
        $locationResult = $locationInfo->fetch_row();

        $location = $locationResult[0];

        if(!empty($location)){
            echo "<h4>your current location is: $location</h4>";
            echo '<p><a href="availability.php" title="availability">availability near you</a></p>';
        }

        if(empty($location)){
            echo "location is not set, enter location below for availability near you";
        }

       


    ?>


    <h3>Update location</h3>

     <form action="process-location.php" method="post" >
        <div>
            <label for="location">Location</label>
            <input type="text" id="location" name="location">
        </div>

        <button>Submit</button>

    </form>









</body>
</html>


<?php
echo '<p><a href="javascript:history.go(-1)" title="Return to previous page">« Go back</a></p>';
?>