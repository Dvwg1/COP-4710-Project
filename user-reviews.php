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


<h2>Delete a Review:</h2>
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




 <p><a href="index1.php">Return Home</a></p>
</body>
</html>