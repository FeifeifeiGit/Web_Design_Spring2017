<?php
session_start();

// Initiate Server
$servername = "webdesignfinal.ccxaerxt39bn.us-west-2.rds.amazonaws.com:3306";
$usernameServer = "webteam";
$passwordServer = "12345678";
$dbname = "findCircle";

// Create connection
$conn = mysqli_connect($servername, $usernameServer, $passwordServer, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connection succeed<br>";
}

//--------------------------------------------------------------------------
$search = $_SESSION["searchInput"];


$sql="SELECT * FROM Users WHERE FirstName LIKE '%$search%' OR LastName LIKE '%$search%' OR DisplayName LIKE '%$search%'"

$result = mysql_query($sql);
while($row = mysql_fetch_array($result)) {
    echo $row['fieldname'];
    echo $row['FirstName'];
}


//
//
//// If you want to display all results from the query at once:
//    print_r($row);
//
//    // If you want to display the results one by one
//    echo $row['column1'];
//    echo $row['column2']; // etc..





?>