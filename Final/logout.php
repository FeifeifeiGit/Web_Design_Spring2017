<?php
session_start();
// remove all session variables
 $currentId =$_SESSION['userId'];
include "db.php";
$offlineQuery ="UPDATE Users SET Online=0 WHERE User_Id = '$currentId'";
$offlineResult=mysqli_query($conn, $offlineQuery);
$row = mysqli_fetch_assoc($offlineResult);

session_unset(); 

// destroy the session 
session_destroy(); 
header('Location: login.php');

?>