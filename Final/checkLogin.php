<?php
session_start();
if((!isset($_SESSION['userId'])) || empty($_SESSION['userId'])){
    exit( "<h2>Please login first &nbsp<a href='login.php'>login</a></h2><h3>Don's have an account &nbsp <a href='register.php'>Register Here</a></h3>".$_SESSION['userId']);  
}
?>