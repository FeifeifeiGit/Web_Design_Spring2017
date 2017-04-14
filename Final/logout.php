<?php
session_start();
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
//echo var_dump($_SESSION);
//echo var_dump($_SESSION['userId']);
header('Location: login.php');
//echo "isset".isset($_SESSION['userId']);
?>