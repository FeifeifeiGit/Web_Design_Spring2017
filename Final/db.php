<?php
$servername = "aa9t2zlqk24nsc.ccxaerxt39bn.us-west-2.rds.amazonaws.com:3306";
$username = "dashlorde";
$password = "12345678";
$dbname = "findCircle";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>