<?php

session_start();

$mysqli = require __DIR__ . "/database.php";

$user1 = $_SESSION["username"];


?>

<!DOCTYPE html>
<html>
<head>
    <title>User Reviews</title>
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
    <h1>All Past Reviews:</h1>

<table style ="background-color: GhostWhite ;">
    <tr>
        <th>Drink</th>
        <th>Comment</th>
            <th>Rating</th>
        </tr>
        <tr>
            <?php

                //shows ALL reviews from the user
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


 <p><a href="index1.php">Return Home</a></p>
</body>
</html>