<?php

session_start();

//keeps the page same color
echo '<body style ="background-color: MediumSpringGreen;">';

$mysqli = require __DIR__ . "/database.php";

$uname = $_SESSION["username"];

$oldPass = $_POST["oldPass"];

$newPass = $_POST["newPass"];


//gets current hashed password to compare to old password
$query0 = "SELECT password FROM user WHERE username = '$uname'";
$result0 = $mysqli->query($query0);
$user = $result0->fetch_assoc();


//password validation
if(empty($_POST["oldPass"])){
    die("current password is required");
    exit;
}

if(empty($_POST["newPass"])){
    die("new password is required");
    exit;
}

if(empty($_POST["newPass_confirm"])){
    die("confirm new password");
    exit;
}


//verifies that the password the user entered matches current password
if(!password_verify($oldPass, $user["password"])){
    echo 'Incorrect password! try again!';
    exit;
}
else{
    //password length validation
    if( strlen($_POST["newPass"]) < 8){
        die("Your password must be a minimum of 8 characters");
        exit;
    }

    //password char validation
    if( !preg_match("/[a-z]/i", $_POST["newPass"])){
        die("Your password must contain at least one letter (a-z)");
        exit;
    }

    //password int validation
    if( !preg_match("/[0-9]/i", $_POST["newPass"])){
        die("Your password must contain at least one number (0-9)");
        exit;
    }

    //password confirmation validation
    if($_POST["newPass"] != $_POST["newPass_confirm"]){
        die("Please ensure that passwords match");
        exit;
    }

    //hashes new password
    $newPassword_hash = password_hash($newPass, PASSWORD_DEFAULT);

    //uses UPDATE to update user's email
    $query1 = "UPDATE user SET password = '$newPassword_hash' WHERE username  = '$uname'";
    $result1 = $mysqli->query($query1);


}


header("Location: logout.php");
exit;

?>