<?php


// Initiate Server
$servername = "webdesignfinal.ccxaerxt39bn.us-west-2.rds.amazonaws.com:3306";
$username = "webteam";
$password = "12345678";
$dbname = "findCircle";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


// Set up attributes
$firstName = $lastName = $displayName = $gender = $email = $password = $birthday = $desc = $schoolOrWork = "";
$profilePhoto = null;

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$displayName = $_POST["displayName"];
$gender = $_POST["gender"];
$email = $_POST["email"];
$password = $_POST["password"];
$birthday = $_POST["birthday"];
$desc = $_POST["desc"];
$schoolOrWork = $_POST["schoolOrWork"];



// SQL for register users
$sql="INSERT INTO Users (FirstName,LastName,DisplayName,Gender,Email,Password,Birthday,ProfilePhoto,Description,SchoolOrWork)"
    . " VALUES('$firstName','$lastName','$displayName','$gender','$email','$password','$birthday',NULL,'$desc','$schoolOrWork')";
$result=mysqli_query($conn, $sql);
if($result==false){
    echo "error update<br>";
}

?>