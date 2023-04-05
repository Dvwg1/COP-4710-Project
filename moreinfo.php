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

   

</body>
</html>


<?php
//not a smooth way to get the user back to either advanced or basic recommendations, but it works
//you just have to reload the error page twice lol
echo '<p><a href="javascript:history.go(-1)" title="Return to previous page">« Go back</a></p>';
?>